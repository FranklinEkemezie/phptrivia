<?php

declare(strict_types=1);

namespace App\Utils;

final class ViewRenderer
{

    private function __construct() {}


    private const placeholderNameRegex = "[a-zA-Z_]+";

    /**
     * Render variables in the content of the view
     * @param string $content
     * @param array $placeholderValues
     * @param string $default
     * @param string $options
     * @param ?callable $onError
     * @return string The content of the view with the variables replaced
     * 
     * Variable placeholder names must contain only alphabets (upper and lower case)
     * and underscore character. They are identified as follows:
     * - `{{ var_name }}` - for required variables.
     * - `{{ :var_name}}` - for optional variables.
     * - `{{ var_name.someKey }}` - for the value of the key `someKey` in array variables
     * - `{{ :var_name.someKey}}` - for the value of the key `someKey` in optional array variables
     * - `{{ var_name?.someKey}}` - for the optional value of the key `someKey` in array variables
     * - `{{ :var_name?.someKey }}` - for the optional value of the key `someKey` in optional array variables
     * Spaces around the placeholder names are optional

     */
    public static function renderVariables(
        string $content,
        array $placeholderValues,
        string $default="",
        string $options="",
        ?callable $onError=null
    ): string|array
    {

        $nameRegex = static::placeholderNameRegex;

        // Match the variables
        // Full regex: \{\{ *(:)?([a-zA-Z_]+)((\?)?(\.)?)([a-zA-Z_]+)? *\}\}
        
        $variablesMatchRegex = "/\{\{\s*(:)?($nameRegex)((\?)?(\.)?)($nameRegex)?\s*\}\}/";
        preg_match_all($variablesMatchRegex, $content, $variablesMatches);
        if (empty($variablesMatches[0])) {
            return $content;
        }

        // Set the callback on error, if not given
        $onError ??= fn(string $message): array => [false, $message];

        foreach($variablesMatches[0] as $index => $match) {

            $replace = $placeholderValues[$variablesMatches[2][$index]] ?? $default;

            // Check if the match is a variable
            if ($variablesMatches[5][$index] === "") {
                $placeholder = $variablesMatches[2][$index];
                $replace = $placeholderValues[$placeholder] ?? null;

                $isRequired = $variablesMatches[1][$index] === "";
                $isOptional = $variablesMatches[1][$index] === ":";

                if ($isRequired && is_null($replace)) {
                    return $onError("Failed to provide value for required placeholder '$match'");
                }

                if ($isOptional)
                    $replace ??= $default;
            }
            // Check if the match is an array
            elseif ($variablesMatches[5][$index] === ".") {
                $arrayName = $variablesMatches[2][$index];
                $arrayValue = $placeholderValues[$arrayName] ?? null;

                $isRequired = $variablesMatches[1][$index] === "";
                $isOptional = $variablesMatches[1][$index] === ":";

                // Check if the value provided is an array
                if (is_array($arrayValue)) {

                    // Now, we have an array whose elements is accessed via keys
                    $keyName = $variablesMatches[6][$index];

                    $isKeyRequired = $variablesMatches[3][$index] === ".";
                    $isKeyOptional = $variablesMatches[3][$index] === "?.";

                    $replace = $arrayValue[$keyName] ?? null;

                    $replace = $arrayValue[$keyName] ?? null;

                    if ($isKeyRequired && is_null($replace)) {
                        return $onError("Failed to provide key for array placeholder '$match'");
                    }
    
                    if ($isKeyOptional)
                        $replace ??= $default;

                }
                // Check if the value is not provided but is required
                elseif (is_null($arrayValue) && $isRequired) {
                    return $onError("Failed to provide value for required placeholder '$match'");
                }
                // Check if the value is not provided but optional
                elseif (is_null($arrayValue) && $isOptional) {
                    $replace = $default;
                }
                // Something really stupid happens
                else {
                    return $onError("Value for array placeholder '$match' must be an array not " . gettype($arrayValue));
                }
            }
            // not known, unexpected
            else {
                return $onError("Something went wrong");
            }

            $content = str_replace(
                $match,
                (string) $replace,
                $content
            );
        }

        return $content;
    }


    public static function renderDirectives(
        string $content,
        array $placeholderValues,
        string $options="",
        ?callable $onError=null
    ): string|array
    {

        // Render FOR directives
        $content = static::renderDirectiveFor($content, $placeholderValues, $options, $onError);

        return $content;

    }

    public static function renderDirectiveFor(
        string $content,
        array $placeholderValues,
        string $options="",
        ?callable $onError=null
    ): string|array
    {

        $nameRegex = static::placeholderNameRegex;

        // \{\{\s*@for: *([a-zA-Z_]+) *=> *(:)?([a-zA-Z_]+)\s*\}\}([\s\S]*?)\{\{\s*@endfor\s*\}\}

        $forStartRegex = "\{\{\s*@for: *($nameRegex) *=> *(:)?($nameRegex)\s*\}\}";
        $forEndRegex = "\{\{\s*@endfor\s*\}\}";

        $variablesMatchRegex = "/$forStartRegex([\s\S]*?)$forEndRegex/";
        preg_match_all($variablesMatchRegex, $content, $variablesMatches);
        if (empty($variablesMatches[0])) {
            return $content;
        }

        // Set the callback on error, if not given
        $onError ??= fn(string $message): array => [false, $message];
        
        foreach($variablesMatches[0] as $index => $match) {
            $iterableVariableName = $variablesMatches[3][$index];
            $iterableValue = $placeholderValues[$iterableVariableName] ?? null;

            $isRequired = $variablesMatches[2][$index] === "";
            $isOptional = $variablesMatches[2][$index] === ":";

            // Check if the match array placeholde is required, and given
            if ($isRequired && is_null($iterableValue)) {
                return $onError("Failed to provide value for required placeholder '$match'");
            } elseif ($isOptional && is_null($iterableValue))
                $iterableValue = [];

            $forBlockMatch = ltrim($variablesMatches[4][$index]);
            $forKeyName = $variablesMatches[1][$index];
            $forBlockContent = "";

            // echo <<<INFO
            
            // ------------------------------------------
            // Match: $match
            // For Block Match: $forBlockMatch
            // For Key Name: $forKeyName
            // Content: $forBlockContent
            // ------------------------------------------

            // INFO;


            foreach($iterableValue as $key => $value) {
                $forPlaceholderValues = [
                    $forKeyName => (string) $key,
                    $iterableVariableName => [
                        $forKeyName => $value
                    ]
                ];

                // prettyPrint($forPlaceholderValues);

                $forBlockContent .= static::renderVariables(
                    $forBlockMatch,
                    $forPlaceholderValues
                );
            }

            $content = str_replace(
                $match,
                $forBlockContent,
                $content
            );
        }
        
        return $content;
    }

}
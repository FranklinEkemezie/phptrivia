<section>

    <div class="container-fluid w-100">
        <div class="my-3 ps-2 ps-md-4">

            <h2 class="h2">Your Profile</h2>

            <hr class="w-auto">
        </div>

        <div>
            <div class="row">

                <!-- Column 1 -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-4 pb-md-4">
                        <div class="border rounded-2 p-3">
                            <div class="mb-3">
                                <h3 class="fw-bold">Personal Information</h3>
                                <span class="text-muted">Update your personal details</span>
                            </div>

                            <div>
                                <form action="/profile/edit" method="post">

                                    <div class="my-3">
                                        <label for="username-id" class="fw-bold">Username</label>
                                        <input type="text" name="username" id="username-id" class="form-control" value="{{ username }}" />
                                    </div>

                                    <div class="my-3">
                                        <label for="email-id" class="fw-bold">Email</label>
                                        <input type="email" name="email" id="email-id" class="form-control" value="{{ email }}" />
                                    </div>

                                    <div class="my-3">
                                        <label for="bio-id" class="fw-bold">Bio</label>
                                        <textarea name="bio" id="bio-id" class="form-control" cols="10" rows="5" placeholder="Tell us about yourself..."></textarea>
                                    </div>

                                    <div class="my-3">
                                        <label for="experience-level-id" class="fw-bold">PHP Experience Level ({{ experience-level }})</label>
                                        <select name="experience-level" id="experience-level-id" class="form-select">
                                            <option value="1">Beginner</option>
                                            <option value="2">Intermediate</option>
                                            <option value="3">Advanced</option>
                                        </select>
                                    </div>



                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Column 2 -->
                <div class="col-md-6">

                    <!-- Quiz Statistics -->
                    <div class="p-2 ps-md-2 pe-md-4 pb-md-4">
                        <div class="border rounded-2 p-3">
                            <div class="mb-3">
                                <h3 class="fw-bold">Quiz Statistics</h3>
                            </div>

                            <div>
                                <ul class="list-group list-group-flush px-0 d-flex align-content-center justify-content-between">
                                    <!-- Total quiz completed -->
                                    <li class="list-group-item px-0 d-flex align-content-center justify-content-between">
                                        <span><i class="fa fa-trophy me-2" style="color: #d1b000;"></i> Total Quizzes Completed</span>
                                        <span class="fw-bold">75</span>
                                    </li>

                                    <!-- Average score -->
                                    <li class="list-group-item px-0 d-flex align-content-center justify-content-between">
                                        <span><i class="fa fa-crosshairs me-2" style="color: #7ac57a;"></i> Average Score</span>
                                        <span class="fw-bold">85%</span>
                                    </li>

                                    <!-- PHP Mastery Level -->
                                    <li class="list-group-item px-0 d-flex align-content-center justify-content-between">
                                        <span><i class="fas fa-brain me-2" style="color: #8181ff;"></i> PHP Mastery Level</span>
                                        <span class="fw-bold">Intermediate</span>
                                    </li>
                                </ul>
                                
                            </div>

                        </div>
                    </div>

                    <!-- Learning Goals -->
                    <div class="p-2 ps-md-2 pe-md-4 pb-md-4">
                        <div class="border rounded-2 p-3">
                            <div class="mb-3">
                                <h3 class="fw-bold">Learning Goals</h3>
                            </div>

                            <div>
                                <ul class="list-group list-group-flush px-0 d-flex align-content-center justify-content-between">
                                    <li class="list-group-item px-0">
                                        <i class="fa fa-book me-2" style="color: #8b028b;"></i> Master PHP 8 Features
                                    </li>
                                    <li class="list-group-item px-0">
                                        <i class="fa fa-book me-2" style="color: #8b028b;"></i> Learn Laravel Framework
                                    </li>
                                    <li class="list-group-item px-0">
                                        <i class="fa fa-book me-2" style="color: #8b028b;"></i> Improve PHP Security Knowledge
                                    </li>
                                </ul>

                                <button class="btn btn-outline-primary my-3">
                                    <i class="fa fa-plus"></i>
                                    Add New Goal
                                </button>
                                
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>

</section>
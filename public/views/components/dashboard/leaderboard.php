<section>
    <div class="container-fluid w-100">
        <div class="my-3 ps-2 ps-md-4">
            <h2 class="h2">Leaderboard</h2>
            <hr class="w-auto">
        </div>

        <div class="container-fluid p-2 p-md-4">
            <div class="border rounded-2 p-4">
                <div class="mb-3">
                    <h3 class="fw-bold">Top Performers</h3>
                </div>

                <div class="container row mt-3">
                    <!-- Winner -->
                    <div class="col-md-4">

                        <div class="text-center my-3">
                            <i class="fa fa-trophy fa-4x" style="color: gold;"></i>
                            <div class="fw-bold mt-2 mb-1 fs-5">Jane Doe</div>
                            <span class="text-muted">9800 points</span>
                        </div>
                    </div>

                    <!-- First runner up -->
                    <div class="col-md-4">

                        <div class="text-center my-3">
                            <i class="fa fa-medal fa-4x" style="color: silver;"></i>
                            <div class="fw-bold mt-2 mb-1 fs-5">John Smith</div>
                            <span class="text-muted">9800 points</span>
                        </div>
                    </div>

                    <!-- Second runner up -->
                    <div class="col-md-4">

                        <div class="text-center my-3">
                            <i class="fa fa-award fa-4x" style="color: #cd7f32;"></i>
                            <div class="fw-bold mt-2 mb-1 fs-5">Alice Johnson</div>
                            <span class="text-muted">9400 points</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-2 p-md-4">
            <div>
                <div class="d-flex align-items-center justify-content-between">
                    <!-- Choose time range -->
                    <select name="time-range" id="time-range-id" class="form-select w-auto">
                        <option value="1">All Time</option>
                        <option value="2">Last Week</option>
                        <option value="3">Last Month</option>
                    </select>

                    <button class="btn btn-outline-secondary">View My Ranking</button>

                </div>

                <div class="my-3">
                    <table class="table align-middle table-striped table-hover border rounded-2">
                        <thead>
                            <tr>
                                <th class="border-bottom">Rank (#)</th>
                                <th class="border-bottom">Name</th>
                                <th class="border-bottom">Quizzes Completed</th>
                                <th class="border-bottom">Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jane Doe</td>
                                <td>120</td>
                                <td>9800</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Doe</td>
                                <td>120</td>
                                <td>9800</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Jane Doe</td>
                                <td>120</td>
                                <td>9800</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>John Doe</td>
                                <td>120</td>
                                <td>9800</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Jane Doe</td>
                                <td>120</td>
                                <td>9800</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



        </div>

    </div>
</section>
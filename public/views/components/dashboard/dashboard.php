<section>
    <div class="container-fluid w-100">
        <div class="my-3 ps-2 ps-md-4">

            <h2 class="h2">Dashboard</h2>

            <hr class="w-auto">

            <p class="lead fw-bold">Hello, <span class="text-primary">{{ username }}</span></p>
        </div>

        <div>

            <div class="row">
                <!-- Total quizzes completed -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-4 pb-md-4">
                        <div class="border rounded-2 p-3 bg-light">
                            <div class="d-flex align-content-center justify-content-between">
                                <span>Total Quizzes Completed</span>
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="fs-3 fw-bold">24</div>
                            <div class="text-muted small">+2 from last week</div>
                        </div>
                    </div>
                </div>

                <!-- Average score -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-2 pe-md-4 pb-md-4">
                        <div class="border rounded-2 p-3 bg-light">
                            <div class="d-flex align-content-center justify-content-between">
                                <span>Average Score</span>
                                <i class="fa fa-arrow-up text-success"></i>
                            </div>
                            <div class="fs-3 fw-bold">85%</div>
                            <div class="text-muted small">+5% from last month</div>
                        </div>
                    </div>
                </div>

                <!-- PHP Mastery Level -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-4 pb-md-4">
                        <div class="border rounded-2 p-3 bg-light">
                            <div class="d-flex align-content-center justify-content-between">
                                <span>PHP Mastery Level</span>
                                <i class="fa fa-medal text-warning"></i>
                            </div>
                            <div class="fs-3 fw-bold">Intermediate</div>
                            <div class="my-1">

                                <div class="progress rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-secondary" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Streak -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-2 pe-md-4 pb-md-4">
                        <div class="border rounded-2 p-3 bg-light">
                            <div class="d-flex align-content-center justify-content-between">
                                <span>Streak</span>
                                <i class="bi bi-lightning-fill text-danger"></i>
                            </div>
                            <div class="fs-3 fw-bold">7 days</div>
                            <div class="text-muted small">Keep it up!</div>
                        </div>
                    </div>
                </div>

                <!-- Previous quiz attempts -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-4 pb-md-4">
                        <div class="border rounded-2 p-3">
                            <div class="d-flex align-content-center justify-content-between">
                                <h3 class="h4 fw-bold">Recent Quizzes</h3>
                                <i class="fa fa-clock text-muted"></i>
                            </div>
                            <div class="text-muted small">Your last quiz attempts</div>
                            <div>
                                <div class="list-group list-group-flush my-3 bg-transparent">
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <span>
                                            <i class="fa fa-code me-2 text-primary"></i>
                                            PHP Basics
                                        </span>
                                        <span class="text-secondary">60%</span>
                                    </a>
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <span>
                                            <i class="fa fa-code me-2 text-primary"></i>
                                            OOP in PHP
                                        </span>
                                        <span class="text-secondary">60%</span>
                                    </a>
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <span>
                                            <i class="fa fa-code me-2 text-primary"></i>
                                            PHP Security
                                        </span>
                                        <span class="text-secondary">60%</span>
                                    </a>
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <span>
                                            <i class="fa fa-code me-2 text-primary"></i>
                                            Laravel Fundamentals
                                        </span>
                                        <span class="text-secondary">60%</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quiz recommendations -->
                <div class="col-md-6">
                    <div class="p-2 ps-md-2 pe-md-4 pb-md-4">
                        <div class="border rounded-2 p-3 shadow-sm bg-gradient">
                            <div class="d-flex align-content-center justify-content-between">
                                <h3 class="h4 fw-bold">Recommended Quizzes</h3>
                                <i class="fas fa-thumbs-up text-black-50"></i>
                            </div>
                            <div class="text-muted small">Based on your performance</div>

                            <div>
                                <div class="list-group list-group-flush my-3 bg-transparent">
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-book me-2 text-primary"></i>
                                            Advanced PHP Techniques            
                                        </div>
                                        <i class="fa fa-chevron-right text-secondary"></i>
                                        
                                    </a>
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-book me-2 text-primary"></i>
                                            PHP 8 Features            
                                        </div>
                                        <i class="fa fa-chevron-right text-secondary"></i>
                                        
                                    </a>
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-book me-2 text-primary"></i>
                                            Symfony Framework            
                                        </div>
                                        <i class="fa fa-chevron-right text-secondary"></i>
                                        
                                    </a>
                                    <a href="" class="list-group-item list-group-item-action border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="fa fa-book me-2 text-primary"></i>
                                            API Development with PHP            
                                        </div>
                                        <i class="fa fa-chevron-right text-secondary"></i>
                                        
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Learning Path -->
                <div class="col-md-12">
                    <div class="p-2 px-md-4 pb-4">
                        <div class="border rounded-2 p-3 shadow-sm bg-gradient">
                            <div class="d-flex align-content-center justify-content-between">
                                <h3 class="h3 fw-bold">Learning Path</h3>
                                <i class="fas fa-route"></i>
                            </div>
                            <div class="text-muted small">Track your progress towards PHP Mastery</div>
                            <div>
                                <div class="my-3">
                                    <span>PHP Basics</span>
                                    <div class="progress my-1 rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary" style="width: 0%">0%</div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <span>Object-Oriented PHP</span>
                                    <div class="progress my-1 rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary" style="width: 25%">25%</div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <span>PHP Security</span>
                                    <div class="progress my-1 rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary" style="width: 50%">50%</div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <span>PHP Frameworks</span>
                                    <div class="progress my-1 rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary" style="width: 75%">75%</div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <span>Advanced PHP Concepts</span>
                                    <div class="progress my-1 rounded-pill" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary" style="width: 100%">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



</section>


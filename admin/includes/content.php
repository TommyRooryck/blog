<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="page-header">
                Dashboard
            </h1>
            <div class="row">

                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo /*count($aantalUsers);*/ User::count_all(); ?></div> <!-- Count() geeft het aantal weer -->
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calender fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Photos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo /*count($aantalPhotos)*/ Photo::count_all(); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calender fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Comments</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo /*count($aantalComments)*/ Comment::count_all(); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calender fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mx-auto" id="piechart" style="height: 500px; width: 900px; "></div> <!--Komt uit javascript zie admin/includes/header.php -->
            </div>

        </div>
    </div>
</div>

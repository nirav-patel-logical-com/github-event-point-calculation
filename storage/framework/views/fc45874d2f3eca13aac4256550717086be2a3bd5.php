<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Github Event Score Calculation</div>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->all()): ?>
                        <div class="alert alert-danger left-icon-alert" role="alert">
                            <strong>Oh snap!</strong>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>

                    <!-- Start Form -->

                        <form class="form-horizontal" name="score_calculation" method="POST" action="<?php echo e(route('event_score')); ?>" id="score_calculation">
                            <fieldset>
                                <!-- Text input Enter Name-->
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="Enter Your Name" class="form-control input-md">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <!-- Submit Button -->

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button id="submit_btn" name="submit_btn" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>


                                <?php if(session()->has('point')): ?>
                                    <?php ($total = 0); ?>
                                    <ul>
                                    <?php $__currentLoopData = session()->get('point'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php ($total += $value); ?>
                                        <li><?php echo e($key); ?> : <?php echo e($value); ?> </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>

                                    <h5>Total Points :  <?php echo e($total); ?></h5>
                                <?php endif; ?>


                            </fieldset>
                        </form>

                    <!-- End Form -->

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
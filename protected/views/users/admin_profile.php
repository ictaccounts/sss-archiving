<?php $id = Users::model()->get_id_by_email(Yii::app()->user->name);
$model = $this->loadModel($id);

// echo $model->user_fullname;

?>
<div class="slim-mainpanel">
	<div class="container">
		<div class="manager-header">
		<div class="row row-sm">
                <div class="col-sm-6 col-lg-4">
                  <div class="card-contact">
                    <div class="tx-center">
                      <!-- <a href=""><img src="http://via.placeholder.com/500x500" class="card-img" alt=""></a> -->
                      <h5 class="mg-t-10 mg-b-5"><a href="" class="contact-name"><?php echo $model->user_fullname; ?></a></h5>
                      <p><?php echo $model->user_company; ?></p>
                     
                    </div><!-- tx-center -->

                    <p class="contact-item">
                      <span>Email:</span>
                      <span><?php echo $model->user_email; ?></span>
                    </p><!-- contact-item -->
                    <p class="contact-item">
                      <span>Password:</span>
                      <span><?php echo $model->user_password_decrypt; ?></span>
                    </p><!-- contact-item -->
                    <p class="contact-item">
                      <span>Role:</span>
                      <span><?php echo $model->user_role == 1 ? 'Administrator' : 'Client'; ?></span>
                    </p><!-- contact-item -->
					<p class="contact-item">
                      <span>Department:</span>
                      <span><?php echo $model->user_department; ?></span>
                    </p><!-- contact-item -->
                  </div><!-- card -->
                </div><!-- col -->
			  </div>
		</div><!-- manager-header -->

	</div>
</div>



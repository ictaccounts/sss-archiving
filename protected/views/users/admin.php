<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
/* @var $this UsersController */
/* @var $model Users */

// $this->breadcrumbs = array(
// 	'Users' => array('index'),
// 	'Manage',
// );

// $this->menu = array(
// 	array('label' => 'List Users', 'url' => array('index')),
// 	array('label' => 'Create Users', 'url' => array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="slim-mainpanel">
	<div class="container">
		<div class="manager-header">
			<div class="slim-pageheader">
				<ol class="breadcrumb slim-breadcrumb">
					<!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page">File Manager</li> -->
				</ol>
				<h6 class="slim-pagetitle">Manage Users</h6>
			</div><!-- slim-pageheader -->
			<a id="managerNavicon" href="" class="contact-navicon"><i class="icon ion-navicon-round"></i></a>
		</div><!-- manager-header -->



		<div class="section-wrapper mg-t-20">
			<div class="row">
				<div class="col-lg-2">

				</div>
			</div>

			<div class="search-form" style="display:none">
				<?php $this->renderPartial('_search', [
                    'model' => $model,
                ]); ?>
			</div><!-- search-form -->
			<div class="table-responsive">
				<div class="row mg-t-20">
					<div class="col-lg-8">
					</div>
					<div class="col-lg-2">
						<?php echo CHtml::link('Show Filter', '#', ['class' => 'search-button btn btn-primary btn-block mg-b-10 btn-sm ']); ?>
					</div>
					<div class="col-lg-2">
						<a class="btn btn-primary btn-block btn-sm mg-b-10" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/create"><i class="fa fa-plus mg-r-5"></i>ADD USER</a>
					</div>
				</div>
				<table class="table table-bordered mg-t-20">
					<thead class="thead-colored bg-primary">
						<tr>
							<th class="wd-30p">Name</th>
							<th class="wd-20p">Agency/Company</th>
							<th class="wd-20p">Department</th>
							<th class="wd-20p">Email</th>
							<th class="wd-20p">Role</th>
							<th class="wd-10p">Edit</th>
							<th class="wd-10p">Delete</th>

						</tr>
					</thead>
					<tbody>

						<?php
                        foreach (Users::model()->search($_GET)->getdata() as $val) {
                            ?>

							<tr>
								<th scope="row"><?php echo $val['user_fullname']; ?></th>
								<td><?php echo $val['user_company']; ?></td>
								<td><?php echo $val['user_department']; ?></td>
								<td><?php echo $val['user_email']; ?></td>
								<td><?php echo $val['user_role'] == 1 ? 'Admin' : 'Client'; ?></td>
								<td> <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=users/update&id=<?php echo $val['id']; ?>&pass=<?php echo $val['id']; ?>" class="btn btn-primary btn-sm btn-icon rounded-circle">
										<div><i class="fa fa-pencil"></i></div>
									</a>
								</td>
								<td> <span style="pointer:cursor" class="btn btn-danger btn-sm btn-icon rounded-circle" onclick="deletetran(<?php echo $val['id']; ?>)">
										<div><i class="fa fa-trash"></i></div>
									</a>
								</td>
							</tr>

						<?php
                        } ?>

					</tbody>
				</table>

			</div>
		</div>

		<?php
        // $this->widget('zii.widgets.grid.CGridView', array(
        // 	'id' => 'users-grid',
        // 	'dataProvider' => $model->search(),
        // 	'filter' => $model,
        // 	'columns' => array(
        // 		'id',
        // 		'user_fullname',
        // 		'user_company',
        // 		'user_email',
        // 		'user_password',
        // 		'user_role',
        // 		/*
        // 'created_at',
        // */
        // 		array(
        // 			'class' => 'CButtonColumn',
        // 		),
        // 	),
        // ));
        ?>
	</div>
</div>




<script>

function deletetran(id){

	// alert(id)

	

	Swal.fire({
		title: 'Are you sure?',  
		text: 'You want to delete this user?',
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: 'red',
		cancelButtonColor: 'gray',
		confirmButtonText: 'Yes, delete it!'
	
	}).
						then((result) => {

							if (result.isConfirmed) {    
								$.ajax({
                                   url: '<?php echo $this->createUrl('users/deleteTran'); ?>',
                                   type: 'POST',
                                   dataType: 'html',
                                   data: {
                                       'data': "1",

                                       'id': id,

                                       'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>',
                                   },
                                   success: function (response, status, data) {

										Swal.fire('Deleted',
										'User successfully deleted',
										'success').
										then((result) => {
											location.reload();
										})
                                   },
                                   error: function (xhr, status, error) {
                                       alert("Error Update")



                                   }
                               });
							} else if (result.isDenied) {    
							
							}

					
					});

}
</script>
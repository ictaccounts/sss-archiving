<?php
/* @var $this HistoryLogsController */
/* @var $model HistoryLogs */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#history-logs-grid').yiiGridView('update', {
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
				<h6 class="slim-pagetitle">Activity Logs</h6>
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
					<div class="col-lg-10">
					</div>
					<div class="col-lg-2">
						<?php echo CHtml::link('Show Filter', '#', ['class' => 'search-button btn btn-primary btn-block mg-b-10 btn-sm ']); ?>
					</div>
					
				</div>
				<table class="table table-bordered mg-t-20">
					<thead class="thead-colored bg-primary">
						<tr>
							<th class="wd-30p">Activity</th>
							<th class="wd-20p">Date/Time</th>
							<th class="wd-20p">User</th>
						</tr>
					</thead>
					<tbody>

						<?php
                        foreach (HistoryLogs::model()->search_client($_GET)->getdata() as $val) {
                            ?>

							<tr>
								<th scope="row"><?php echo $val['logs']; ?></th>
								<td><?php echo date('M d, Y | h:i:s A', strtotime($val['created_at'])); ?></td>
								<td><?php echo Users::model()->get_fullname_by_id($val['created_by']); ?></td>
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
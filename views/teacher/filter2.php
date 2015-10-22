<?php
	use yii\grid\GridView;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;

	$this->title = 'Список учителей с наибольшим количеством общих учеников';
?>
<br><br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Список учителей</th>
			<th>Список учеников</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Имя</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($teachers as $teacher): ?>
							<tr>
								<td><?= $teacher->id ?></td>
								<td><?= $teacher->name ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
			<td>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Имя</th>
							<th>Email</th>
							<th>Дата рождения</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($students as $student): ?>
							<tr>
								<td><?= $student->id ?></td>
								<td><?= $student->name ?></td>
								<td><?= $student->email ?></td>
								<td><?= $student->birthday ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>


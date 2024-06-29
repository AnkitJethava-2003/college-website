<div class="card-body">
	<div class="table-responsive">
		<table>
			<thead>
				<th>ID</th>
				<th>UserName</th>
				<th>FileName</th>
			</thead>
			<tbody>
				<?php
                include_once 'dbcon.php';
					$selectQuery = "select * from filename";
					$squery = mysqli_query($con, $selectQuery);
					
					while (($result = mysqli_fetch_assoc($squery))) {
				?>
				<tr>
				<td><?php echo $result['id']; ?></td>
				<td><?php echo $result['username']; ?></td>
				<td><?php echo $result['filename']; ?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>			
	</div>
</div>

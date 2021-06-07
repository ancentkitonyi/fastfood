<div class="mymenu" id="mymenu">
	<div class="container">
		<div class="topic">
			<h1>Our Menu</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<nav>
				  <div class="nav nav-tabs" id="nav-tab" role="tablist">
				  	<?php
						$sql="select * from category order by catid asc limit 1";
						$fquery=$conn->query($sql);
						$frow=$fquery->fetch_array();
					?>
				    <a class="nav-item nav-link active tab" data-toggle="tab" href="#<?php echo $frow['catname'] ?>"><?php echo $frow['catname'] ?></a>
				    <?php
						$sql="select * from category order by catid asc";
						$nquery=$conn->query($sql);
						$num=$nquery->num_rows-1;

						$sql="select * from category order by catid asc limit 1, $num";
						$query=$conn->query($sql);
						while($row=$query->fetch_array()){
							?>
				    		<a class="nav-item nav-link tab" data-toggle="tab" href="#<?php echo $row['catname'] ?>"><?php echo $row['catname'] ?></a><?php } 
				    ?>
				  </div>
				</nav>
				<div class="tab-content">
				<?php
				$sql="select * from category order by catid asc limit 1";
				$fquery=$conn->query($sql);
				$ftrow=$fquery->fetch_array();
				?>
					<div id="<?php echo $ftrow['catname']; ?>" class="tab-pane fade show active" style="margin-top:20px;">
						<div class='row'>
						<?php

							$sql="select * from food where catid='".$ftrow['catid']."'";
							$pfquery=$conn->query($sql);
							while($pfrow=$pfquery->fetch_array()){
								?>
									<div class="col-md-4">
										<div class="product">
												<div class="foodimg">
													<img src="<?php if(empty($pfrow['fphoto'])){echo "img/logo1.png";} else{echo $pfrow['fphoto'];} ?>">
												</div>
												<div class="food">
													<b><?php echo $pfrow['fname']; ?></b>
												</div>
												<div class="price">
													Ksh <?php echo number_format($pfrow['fprice'], 2); ?>
												</div>
												<div>
													<a href="add_cart.php?fid=<?php echo $pfrow['fid']; ?>"><button class="ordernow" type="submit">Order Now!</button></a>
												</div>
										</div>
									</div>
								<?php
							}
						?>
						</div>
			    	</div>

					<?php
					$sql="select * from category order by catid asc";
					$tquery=$conn->query($sql);
					$tnum=$tquery->num_rows-1;

					$sql="select * from category order by catid asc limit 1, $tnum";
					$cquery=$conn->query($sql);
					while($trow=$cquery->fetch_array()){
						?>
						<div id="<?php echo $trow['catname']; ?>" class="tab-pane fade" style="margin-top:20px;">
							<div class="row">
							<?php

								$sql="select * from food where catid='".$trow['catid']."'";
								$pquery=$conn->query($sql);
								while($prow=$pquery->fetch_array()){ 
									?>
										<div class="col-md-4">
											<div class="product">
												<form method="post" action="">
												<input type="hidden" name="fid" value="<?php echo $prow['fid']; ?>">
												<div class="foodimg">
													<img src="<?php if(empty($prow['fphoto'])){echo "img/logo1.png";} else{echo $prow['fphoto'];} ?>">
												</div>
												<div class="food">
													<b><?php echo $prow['fname']; ?></b>
												</div>
												<div class="price">
													Ksh <?php echo number_format($prow['fprice'], 2); ?>
												</div>
												<div>
													<a href="add_cart.php?fid=<?php echo $prow['fid']; ?>"><button type="submit" class="ordernow">Order Now!</button></a>
												</div>
												</form>
											</div>
										</div>
									<?php
									}
								?>
				    		</div>
				    	</div>
						<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
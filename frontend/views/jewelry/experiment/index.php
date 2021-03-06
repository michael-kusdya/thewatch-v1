<?php
include '../shared/head_param.php';
include '../shared/head_products.php';
include '../shared/head_global.php';

echo '<style>';
	include '../shared/shared.css'; 
echo '</style>';

$now = date("Y-m-d H:i:s");
$brand_start_date = '2019-02-07 00:00:00';
$brand_end_date = '2019-02-15 00:00:00';
?>

<section class="ptop1">
    <div class="container">
        <div class="row">

			<?php
			echo Yii::$app->view->renderFile('@app/shared/brand_detail_description.php', array(
				"image" => $data[2],
				"title"=> $data[0],
				"description" => $data[1]
			));
			?>
			
			<div class="clear"></div>
			
			<?php 
			include '../shared/breadcrumb.php'; 

            if($current_date >= $brand_start_date && $current_date <= $brand_end_date){
				if (count($products) > 0) {
				?>

				<section id="all-product">
				  <div class="hidden-sm container product-box clearleft" style="padding-top:20px;">

					<div class="row">
					  <!-- Filter Desktop -->
					  <?php
						echo Yii::$app->view->renderFile('@app/views/promo/filter.php', array(
							"feature" => $feature,
							"brands" => $brands,
							"brands_selection" => $brands_selection,
							"types_selection" => $types_selection,
							"genders_selection" => $genders_selection,
							"size_selection" => $size_selection,
							"bandwidth_selection" => $bandwidth_selection,
							"movements_selection" => $movements_selection,
							"waters_selection" => $waters_selection,
							"limit"=>$limit,
						"sortby"=>$sortby,
						));
					  ?>

					<?php $i = 1; ?>

					<div class="col-lg-10 product-box space-cont-product flex-product"  >
					<?php foreach ($products as $product) { ?>
				
						<div>
							<div class="col-lg-3 col-md-3 space-product col-xs-6">
								<?php
									$stock = backend\models\ProductStock::findOne(['product_id' => $product->product_id]);
									$productStock = backend\models\ProductStock::findAll(['product_id' => $product->product_id]);
									$found = FALSE;
									foreach ($productStock as $attribute){
										$productattribute = backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
										if($productattribute != NULL && $attribute->quantity != 0){
											$found = TRUE;
										}
									}

									if($stock != NULL && !$found){
								?>
								<a class="productClick" <?php echo $stock->quantity == 0 ? 'id="out-of-stock" data-id="'.$product->product_id.'"' : ''; ?> href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
									<?php } else { ?>
									<a class="productClick" href="<?php echo \yii\helpers\Url::base(); ?>/product/<?php echo $product->productDetail->link_rewrite; ?>">
									<?php } ?>
									<div>
										<div class="tag">
											<?php
											if (!empty($product->specificPrice)) {
												if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
													?>
													<div class='pull-right'>
														<div class='<?php echo $product->specificPrice->label_type === "custom_value" ? "rounded" : "circle"; ?>'>
															<span class='text-discount' style=''>
																<?php
																// if custom value label
																if($product->specificPrice->label_type == "custom_value"){
																	echo $product->specificPrice->label;
																} else {
																	if ($product->specificPrice->reduction_type == 'amount') {
																		echo round($product->specificPrice->reduction / 1000, 2);
																	} else {
																		echo $product->specificPrice->reduction;
																	}
																	echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
																}
																?>
															</span>
														</div>
													</div>
													<?php
												}
											}
											?>
										</div>
										<?php
											if (!empty($product->specificPrice)) {
												if ($product->specificPrice->from <= $now && $product->specificPrice->to > $now) {
													?>
														<div class="tag-bellow tag-bellow2" style='background-color: #ae4a3b;'>
														<div class=''>
															<span class='text-bellow'>
															Sale
																<?php
																// if custom value label
																if($product->specificPrice->label_type == "custom_value"){
																	echo $product->specificPrice->label;
																} else {
																	if ($product->specificPrice->reduction_type == 'amount') {
																		echo round($product->specificPrice->reduction / 1000, 2);
																	} else {
																		echo $product->specificPrice->reduction;
																	}
																	echo $product->specificPrice->reduction_type == 'percent' ? '%' : 'k';
																}
																?> Off
															</span>
														</div>
													</div>

													<?php
												}
											}
											?>
												
										<?php
										if($stock != NULL){
										?>
										<div class='figcaption-wrap'>
											<img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" id="out-of-stock-<?php echo $product->product_id; ?>" class="img-responsive <?php echo $stock->quantity == 0 ? 'out-of-stock' : ''; ?>">
											<?php
													if($product->productNewArrival->product_newarrival_start_date <= $now && $product->productNewArrival->product_newarrival_end_date >= $now){
												?>
														<div class="tag-bellow-custom" style='background-color: #4c757b;'>
														<div class=''>
															<span class='text-bellow'>
															New Arrival
															</span>
														</div>
													</div>

													<?php
													}
													?>
										</div>
										<?php
											echo $stock->quantity == 0 ? '<span id="out-of-stock-caption-'.$product->product_id.'" class="hidden-xs gotham-medium fsize-2 out-of-stock-caption" style="display: none;">OUT OF STOCK</span>' : '';
										?>
										<?php
										} else {
										?><img alt="<?php echo $product->brands->brand_name . ' ' . $product->productDetail->name; ?>" src="<?php echo Yii::$app->params['imgixUrl'] ?>product/<?php echo $product->productImage->product_image_id . '/' . $product->productImage->product_image_id; ?>.jpg" class="img-responsive">

										<?php } ?>
									</div>
									<input type="hidden" name="productId" value="<?php echo $product->product_id; ?>">
									<input type="hidden" name="productName" value="<?php echo $product->productDetail->name; ?>">
									<input type="hidden" name="brandName" value="<?php echo $product->brands->brand_name; ?>">
									<input type="hidden" name="opt_list" value="<?php echo $breadcrumbs[0] . ' - ' . $breadcrumbs[2]; ?>">
									<input type="hidden" name="productCategory" value="<?php echo $product->productCategory->product_category_name; ?>">
									<input type="hidden" name="productPosition" value="<?php echo $i; ?>">
									<div class="col-lg-12 col-md-12 col-sm-12 product brand-title"><?php echo strtoupper($product->brands->brand_name); ?></div>
									<div class="col-lg-12 col-md-12 col-sm-12 product product-name"><span class="lspace0-5"><?php echo ucwords($product->productDetail->name); ?></span></div>
									
									<?php
										// if product has discount
										$spesificPrice = backend\models\SpecificPrice::findOne(['product_id' => $product->product_id]);
										$discount = 0;
										$now = date('Y-m-d H:i:s');
										if ($spesificPrice != null) {
											?>
											<?php if (date('Y-m-d H:i:s', strtotime($spesificPrice->from)) > $now || date('Y-m-d H:i:s', strtotime($spesificPrice->to)) <= $now) { ?>

												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
													<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
													IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
													<input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
													<?php } else { ?>
													USD <?php echo $product->price_usd; ?>
													<input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
													<?php } ?>
													<input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
												</div>
											<?php } else { ?>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview1">
													<?php
													if ($spesificPrice->reduction_type == 'percent') {
														$discount = (($spesificPrice->reduction / 100) * $product->price);
													} elseif ($spesificPrice->reduction_type == 'amount') {
														$discount = $spesificPrice->reduction;
													}
													?>
													<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
													<span class="discount-price mleft2 discountview2">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?></span>
													<span class="discount-price-real">IDR <?php echo \common\components\Helpers::getPriceFormat($product->price - $discount); ?></span>
													<input type="hidden" class="price" name="price" value="<?php echo $product->price - $discount; ?>">
													<?php } else { ?>
													USD <?php echo $product->price_usd - $discount; ?>
													<input type="hidden" class="price" name="price" value="<?php echo $product->price_usd - $discount; ?>">
													<?php } ?>


													<input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
												</div>



											<?php } ?>
										<?php } else { ?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-price discountview">
												<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
												IDR <?php echo \common\components\Helpers::getPriceFormat($product->price); ?>
												<input type="hidden" class="price" name="price" value="<?php echo $product->price; ?>">
												<?php } else { ?>
												USD <?php echo $product->price_usd; ?>
												<input type="hidden" class="price" name="price" value="<?php echo $product->price_usd; ?>">
												<?php } ?>

												<input type="hidden" class="weight" name="weight" value="<?php echo $product->weight; ?>">
											</div>
										<?php } ?>
										<input type="hidden" name="productPrice" value="<?php echo $product->price - $discount; ?>">
									<!--<div class="col-lg-12 col-md-12 col-sm-12 product product-price"><span class="lspace2">IDR <?php //echo \common\components\Helpers::getPriceFormat($product->price); ?></span></div> -->
									<?php
									if($stock->quantity == 0){
										?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-out">
										Out of Stock
										</div>
										<?php
									}else{
										if(($product->price - $discount) > 500000){
										?>
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product-detail product-installment" style="text-align: left;">
												<?php if(!isset($_COOKIE['currency']) || $_COOKIE['currency'] == "idr"){ ?>
												IDR <?php echo \common\components\Helpers::getPriceFormat(($product->price - $discount) / 12); ?> / bulan

												<?php } else { ?>
												USD <?php echo ($product->price_usd - $discount)/12; ?> / bulan

												<?php } ?>
											</div>
										<?php
											}
									}
								?>
								</a>
							</div>
						</div>
						
					<?php } ?>
					
					</div>
				  </div>
				</section>
			
				<section id="all-product-footer">
					<div class="container product-box">
						<div class="row font-paging">
							<?php
							if(!isset($_GET['limit'])){
								$limit = 20;
								$total_page = ceil($count / $limit);
							}else{
								$total_page = ceil($count / $limit);
							}

							if(!isset($_GET['page'])){
								$current = 1;
							}else{
								$current = $_GET['page'];
							}
							?>

							<?php
								echo Yii::$app->view->renderFile('@app/views/brands/page_number.php', array(
									"current" => $current,
									"breadcrumbs" => $breadcrumbs,
									"total_page" => $total_page,
									"limit" => $limit,
									"params"=> $params,
									"sortby"=> $sortby,
									"currentAc"=>$currentAc,
								));
							?>
						</div>

					</div>
					<hr>
					<div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright" style="text-align: center;">
						<a href="#" class="scrolls" style="color:#a8a9ad;">TOP</a>
					</div>
				</section>
				<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>
			<?php } else { ?>
			<section id="product">
			  <div class="hidden-sm container product-box clearleft">
				<div class="row">
				  <!-- Filter Desktop -->
				  <?php
					  echo Yii::$app->view->renderFile('@app/views/promo/filter.php', array(
						"feature" => $feature,
						"brands" => $brands,
						"brands_selection" => $brands_selection,
						"types_selection" => $types_selection,
						"genders_selection" => $genders_selection,
						"size_selection" => $size_selection,
						"bandwidth_selection" => $bandwidth_selection,
						"movements_selection" => $movements_selection,
						"waters_selection" => $waters_selection,
						"limit"=>$limit,
                            "sortby"=>$sortby,
					  ));
				  ?>
					<div class="col-lg-10 col-md-10 col-sm-10 ptop5 pbottom3">
						<center><span class="gotham-light fsize-1">PRODUCT NOT FOUND</span></center>
					</div>
				</div>
			  </div>
			</section>
			<?php } ?>
            <?php } else { ?>
            <section id="product">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 ptop5 pbottom3">
                        <center><span class="gotham-light fsize-1" style="font-size: 25px;">COMING SOON</span></center>
                    </div>
                </div>
            </section>                 
            <?php } ?>
            	
        </div>
    </div>
</section>


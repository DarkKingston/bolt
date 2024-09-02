<?
include($_SERVER['DOCUMENT_ROOT']."/73naasfalteon.php");
include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/templates/lte/header.php");
include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/lock.php");
include("settings.php");

    if( $User->InGroup( $_params['access'] ) ){ 
    	include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/templates/lte/left_menu.php");
        ?>
        <div class="content-wrapper">
			<section class="content-header">
				<h1><?=$_params['title']?></h1>
			</section>

			<section class="content">

				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
                                <?
                                $fieldToSearch = array();
                                if(isset($_GET['search']) && $_GET['search'] != '') {
                                    $colums = $Db->getall(" select *  from information_schema.columns where table_schema = '" . $DB_NAME . "'  and table_name = '" . $_params['table'] . "' ");
                                    foreach ($colums as $ee => $data) {
                                        $haystack = $data['DATA_TYPE'];
                                        $needle = 'varchar';
                                        $pos = strripos($haystack, $needle);

                                        $needle = 'text';
                                        $pos2 = strripos($haystack, $needle);

                                        if ($pos !== false || $pos2 !== false) {
                                            $fieldToSearch[] = " `".$data['COLUMN_NAME']."` LIKE '%". trim( $_GET['search'] ) ."%' ";
                                        }
                                    }
                                }


                                $query = " SELECT id FROM `".$_params['table']."` WHERE edit_by_user = 1 ";

                                if( !empty( $fieldToSearch ) ) {
                                    $fieldToSearch = " ( ". implode(" OR ", $fieldToSearch ) ." ) ";
                                    $haystack = $query;
                                    $needle = 'WHERE';
                                    $pos = strripos($haystack, $needle);

                                    $needle = 'where';
                                    $pos2 = strripos($haystack, $needle);

                                    if ($pos === false && $pos2 === false) {
                                        $fieldToSearch = " WHERE " . $fieldToSearch;
                                    }
                                    else {
                                        $fieldToSearch = " AND " . $fieldToSearch;
                                    }
                                }
                                else {
                                    $fieldToSearch = " ";
                                }

                                $query = " SELECT id FROM `".$_params['table']."` WHERE edit_by_user = 1 $fieldToSearch ";
                                $Paginator = pagination($query, $_params['num_page']);
                                ?>

                                <form method="get">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="text" name="search" required class="form-control input-sm"/>
                                            <?
                                            foreach ($_GET as $key => $value) {
                                                if($key=='search'){continue;}
                                                ?>
                                                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="glyphicon glyphicon-search"></i> <?=$GLOBALS['CPLANG']['SEARCH_WORD']?>
                                            </button>

                                            <? if(isset($_GET['search']) && $_GET['search'] != '') { ?>
                                                <div class="btn-group backbutton">
                                                    <a class="btn btn-block btn-info btn-xs" href="?"> <?=$GLOBALS['CPLANG']['GO_BACK']?></a>
                                                </div>
                                            <? } ?>
                                        </div>
                                    </div>
                                </form>

							</div>

							<div class="box-body table-responsive no-padding">
								<table class="table table-hover">
									<tr>
										<th> 
											<?=$GLOBALS['CPLANG']['TITLE']?>
										</th>
										<th class="actioncolumn" align="center" style="text-align: center">
											<?=$GLOBALS['CPLANG']['ACTIONS']?>
										</th>
									</tr>
									<?
                                    /** менять SQL во всех переменных $query */
							        $ar_pages = mysqli_query($db,
							        "SELECT * FROM `".$_params['table']."` WHERE `edit_by_user`='1' $fieldToSearch ORDER BY id DESC LIMIT ".$Paginator['from'].", ".$Paginator['per_page']);
							        while ( $Elem = mysqli_fetch_assoc($ar_pages) ) {
							            ?>
							            <tr>
							                <td class="title_line">
							                    <?=$Elem['title_'.$Admin->lang]?><br>
							                </td>
							                <td align="center">
							                	<div class="btn-group wgroup">
							                		<a href="edit_elem.php?id=<?=$Elem['id']?>" class="btn btn-default" title="<?=$GLOBALS['CPLANG']['EDIT_ELEM']?>">
							                			<i class="glyphicon glyphicon-pencil"></i>
							                		</a>
							                	</div>
							                </td>
							            </tr>
							            <?
							        }
							        ?>
								</table>
							</div>
						</div>
					</div>
				</div>
                <?
                paginate($Paginator);  
                ?>
			</section>

		</div>
        <? 
    }        

?>
<?include($_SERVER["DOCUMENT_ROOT"]."/". WS_PANEL ."/templates/lte/footer.php");?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Artists Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary add-artist" href="javascript:;"><i class="fa fa-plus"></i> Add New Artist</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Artists List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>artistsListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($artistsRecords))
                    {
                        $count = 1;
                        foreach($artistsRecords as $record)
                        {
                    ?>
                    <tr>
                      <td class="artist_id" data-id="<?php echo $record->id ?>"><?php echo $count++ ?></td>
                      <td class="artist_name"><?php echo $record->name ?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info editGenre" href="javascript:;" data-userid="<?php echo $record->id; ?>"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteGenre" href="javascript:;" data-userid="<?php echo $record->id; ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<div id="addmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?=base_url('index.php/addNewArtist')?>" method="post" enctype="multipart/form-data">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Artist</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <lable for="genre_name">Artist Name : </lable>
                                <input type="text" name="name" id="genre_name" class="form-control required" maxlength="128" required aria-required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="editmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?=base_url('index.php/editArtist')?>" method="post" enctype="multipart/form-data">
            <!-- Modal content-->
            <input type="hidden" name="artistId" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Artist</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <lable for="genre_name">Artist Name : </lable>
                                <input type="text" name="name" id="genre_name" class="form-control required" maxlength="128" required aria-required="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="deletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?=base_url()?>index.php/deleteArtist" method="post">
            <!-- Modal content-->
            <input type="hidden" name="artistId" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Artist</h4>
                </div>
                <div class="modal-body">
                    <h2>Confirm Delete</h2>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "artistsListing/" + value);
            jQuery("#searchList").submit();
        });

       $(".add-artist").click(function(){
            $("#addmodal").modal('show');
        });

        $(".editGenre").click(function(){
            var id = $(this).parent().parent().find('.artist_id').data('id');
            var name = $(this).parent().parent().find('.artist_name').html();
            var email = $(this).parent().parent().find('.artist_email').html();
            var mobile = $(this).parent().parent().find('.artist_mobile').html();

            $("#editmodal input[name='artistId']").val(id);
            $("#editmodal input[name='name']").val(name);
            $("#editmodal input[name='email']").val(email);
            $("#editmodal input[name='mobile']").val(mobile);
            $("#editmodal").modal('show');
        });

        $(".deleteGenre").click(function(){
            var id = $(this).parent().parent().find('.artist_id').data('id');
            $("#deletemodal input[name='artistId']").val(id);
            $("#deletemodal").modal('show');
        });

    });
</script>

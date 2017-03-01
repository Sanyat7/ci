<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("div#pagination a").click(function() {
                $.ajax({
                    type: "GET",
                    url: $(this).attr('href'),
                    success: function(html){
                        $("#showIt").html(html);
                    }
                });
                return false;
            });
        });

        $(function() {
            $(".showId").click(function() {
                var thisId = $(this).attr('id');
                var thisName = $(this).attr('name');
                var thisAddress = $(this).attr('address');
                var thisList = $(this).attr('list');
                var thisPhone = $(this).attr('phone');
                var thisEmail = $(this).attr('email');
                var thisGrade = $(this).attr('grade');
                var thisDate = $(this).attr('date');
                var thisDetails = $(this).attr('details');
                $('.modal-content').find('input.studentId').val(thisId);
                $('.modal-content').find('input#name').val(thisName);
                $('.modal-content').find('input#address').val(thisAddress);
                $('.modal-content').find('select#list').val(thisList);
                $('.modal-content').find('input#phone').val(thisPhone);
                $('.modal-content').find('input#email').val(thisEmail);
                $('.modal-content').find('input#grade').val(thisGrade);
                $('.modal-content').find('input#date').val(thisDate);
                $('.modal-content').find('textarea#details').val(thisDetails);
            });
        });
        $(function() {
            $(".editThis").click(function() {
                var dataString = $("#studentUpdateForm").serialize();
                var parent = $(this).parent();
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url('thisuser/edit'); ?>",
                    cache: false,
                    data: dataString,
                    success: function(){
                        alert('Done!');
                    },
                    error: function(){
                        alert(thisId2);
                    }
                });
            });

            $(".deleteThis").click(function() {
                var id = $(this).attr('id');
                var parent = $(this).parent();
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url('thisuser/delete'); ?>",
                    cache: false,
                    data:{id : id},
                    success: function(response){
                        try{
                            if(response=='true'){
                                parent.slideUp('slow', function() {$(this).remove();});
                            }

                        }catch(e) {
                            alert('Exception while request..');
                        }
                    },
                    error: function(){
                        alert('Error while request..');
                    }
                });
            });

        });
    </script>

</head>
<body>

<table class="table table-bordered" id="showIt">
    <tr>
        <td><strong>Name</strong></td>
        <td><strong>Address</strong></td>
        <td><strong>Gender</strong></td>
        <td><strong>Check</strong></td>
        <td><strong>List</strong></td>
        <td><strong>Phone</strong></td>
        <td><strong>Email</strong></td>
        <td><strong>Grade</strong></td>
        <td><strong>Reg. Date</strong></td>
        <td><strong>Details</strong></td>
    </tr>
    <?php foreach($posts as $post){?>
        <tr>
            <td><?php echo $post->name;?></td>
            <td><?php echo $post->address;?></td>
            <td><?php echo $post->gender;?></td>
            <td><?php echo $post->check;?></td>
            <td><?php echo $post->list;?></td>
            <td><?php echo $post->phone;?></td>
            <td><?php echo $post->email;?></td>
            <td><?php echo $post->grade;?></td>
            <td><?php echo $post->date;?></td>
            <td><?php echo $post->details;?></td>
            <?php if (user_acces('role1')){?>
            <td><a href="" id="<?php echo $post->id; ?>" name="<?php echo $post->name; ?>" address="<?php echo $post->address; ?>"
                   list="<?php echo $post->list; ?>"
                   phone="<?php echo $post->phone; ?>"
                   email="<?php echo $post->email; ?>"
                   grade="<?php echo $post->grade; ?>"
                   date="<?php echo $post->date; ?>"
                   details="<?php echo $post->details; ?>"
                   data-toggle="modal" data-target="#viewEdit" class="showId">Edit </a> | <a href="#" class="deleteThis" id="<?php echo $post->id; ?>"> Delete </a></td>
            <?php } ?>
        </tr>
        <tr>

        </tr>
    <?php }?>
</table>
<div class="row">
    <div class="col-lg-12" id="pagination" style="text-align: center">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>

<!--            Second Modal for edit -->

<div id="viewEdit" class="modal fade" role="dialog">
    <div class="modal-dialog-lg" style="margin: 0px 50px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Students - Edit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal" id="studentUpdateForm" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Name:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="address">Address:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" yep>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gender">Gender:</label>
                            <div class="col-sm-4">
                                <label class="radio-inline"><input type="radio" name="gender" value="Male"> Male </label>
                                <label class="radio-inline"><input type="radio" name="gender" value="Female"> Female </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="check">Some Random Question:</label>
                            <div class="col-sm-4">
                                <label class="checkbox-inline"><input type="checkbox" name="check" value="option 1">Option 1</label>
                                <label class="checkbox-inline"><input type="checkbox" name="check" value="option 2">Option 2</label>
                                <label class="checkbox-inline"><input type="checkbox" name="check" value="option 3">Option 3</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="list">List:</label>
                            <select class="form-control" id="list" name="list" style="width: 31%; margin-left: 250px">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="phone">Phone:</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="grade">Grade:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="grade" name="grade" placeholder="Enter grade">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="date">Registration Date:</label>
                            <div class="col-sm-4" data-provide="datepicker">
                                <input type="date" class="form-control datepicker" id="date" name="date" placeholder="YYYY-MM-DD" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="details">Details:</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" rows="2" id="details" name="details"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-5">
                                <a href="#" class="editThis" ><input type="hidden" value="" class="studentId" name="id"/> <button type="button" class="btn btn-default" >Update</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>
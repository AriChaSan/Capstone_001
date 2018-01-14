<link href="../custom/calendar/css/bootstrap.min.css" rel="stylesheet">
<link href='../custom/calendar/css/fullcalendar.css' rel='stylesheet' />
<link href="../custom/calendar/css/bootstrapValidator.min.css" rel="stylesheet" />        
<link href="../custom/calendar/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
<script type="text/javascript">
    $("#navHome").addClass('active');
</script>
<ol class="breadcrumb" style="background-color:#60a917;">
  <li style="color:#fff;">Home</li> 
  <li class="active" style="color:#fff;">Calendar of Activities</li>
</ol>

<div class="row">
    <div class="col-md-12 column">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="glyphicon glyphicon-calendar"></i> Calendar</div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>  
        </div>
    </div>
</div>
<div class="modal fade">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div class="errorsss"></div>
            <form class="form-horizontal" id="crud-form">
            <input type="hidden" id="start">
            <input type="hidden" id="end">
                <div class="form-group">
                    <label class="col-md-4 control-label" for="title">Title</label>
                    <div class="col-md-4">
                        <input id="title" name="title" type="text" class="form-control input-md" />
                    </div>
                </div>                            
                <div class="form-group">
                    <label class="col-md-4 control-label" for="description">Description</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="color">Color</label>
                    <div class="col-md-4">
                        <input id="color" name="color" type="text" class="form-control input-md" readonly="readonly" />
                        <span class="help-block">Click to pick a color</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#topNavCalendarNav").addClass('active');
  });
</script>
<script src='../custom/calendar/js/moment.min.js'></script>
<script src="../custom/calendar/js/jquery.min.js"></script>
<script src="../custom/calendar/js/fullcalendar.min.js"></script>
<script src='../custom/calendar/js/bootstrap-colorpicker.min.js'></script>
<script src='../custom/calendar/js/main.js'></script>
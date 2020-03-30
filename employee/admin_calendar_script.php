<script>
    $(function () {
        // Easy pie charts
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },

            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
            editable: true,
            // US Holidays
            events:
                    [
<?php
$sql1 = "select * from service_request where status = 'approved'";
$result1 = mysqli_query($connection, $sql1);
while ($row1 = mysqli_fetch_array($result1)) {
    $serid = $row1['service_id'];
    $serdate = $row1['service_date'];

    $sql = "SELECT * from service where service_id = '$serid'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $sername = $row['service_name'];
        }
        ?>                              {

                                    title: '<?php echo $sername; ?> ',
                                    start: '<?php echo $serdate; ?>',

                                },
    <?php }
}
?>
                    ]

        });
    });


</script>

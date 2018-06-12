<?php
require_once '../php/connect.php';
$query = "";
if ($stmt = $mysqli->prepare());
?>
<div class="ui small modal" id="edit-event-modal">
    <form class="ui form" method="post" action="" enctype="multipart/form-data" id="editEvent">
        <div class="ui form segment">
            <div class="ui horizontal divider">
                <h1>Edit Announcement/Event</h1>
            </div>
            <div class="ui segment">
                <div class="field">
                    <h2 class="ui medium header">Title</h2>
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input placeholder="Title" name="title" type="text">
                    </div>
                </div>

                <div class="field">
                    <h2 class="ui medium header">Content</h2>
                    <textarea rows="3" placeholder="Enter content here..." name="content"></textarea>
                </div>
                <div class="field">
                    <h2 class="ui medium header">Duration</h2>
                    <div class="two fields">
                        <div class="field">
                            <label>Start date</label>
                            <div class="ui calendar" id="rangestart">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="Start" name="start_date">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>End date</label>
                            <div class="ui calendar" id="rangeend">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" placeholder="End" name="end_date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <h2 class="ui medium header">Cover Image</h2>
                    <div class="ui action input">
                        <input type="text" placeholder="Upload Image" readonly>
                        <input type="file" name="cover_image" style="display: none;">
                        <div class="ui icon button">
                            <i class="attach icon"></i>
                        </div>
                    </div>
                </div>
                <button class="ui primary submit button fluid">Add Event</button>
                <div class="ui error message"></div>
            </div>
        </div>
    </form>
</div>

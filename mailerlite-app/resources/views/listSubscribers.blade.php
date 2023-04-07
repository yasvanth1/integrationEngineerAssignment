<!DOCTYPE html>
<html>

<head>
    <title>My Subscribers Page</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.semanticui.min.css">

    <style>
        h1 {
            font-family: "Lucida Console", Monaco, monospace;
            font-size: 3em;
            color: #333;
            text-align: center;
            text-shadow: 2px 2px #eee;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>

<body style="width:70%; margin:auto;">


    <h1>My Subscribers Page</h1>
    <div class="text-center">
        <button id="createSubscriberBtn" class="btn btn-primary">Create Subscriber</button>
    </div>
    <table id="subscribersTable" width='100%' class="ui celled table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Name</th>
                <th>Country</th>
                <th>Date Subscribe</th>
                <th>Subscribe Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically generated -->
        </tbody>
    </table>

    <!-- Modal form -->
    <div class="modal fade" id="editSubscriberModal" tabindex="-1" aria-labelledby="editSubscriberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubscriberModalLabel">Edit Subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSubscriberForm">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" disabled>
                        </div>
                        <div style="display:none" class="form-group">
                            <label for="subscriberId">Id:</label>
                            <input type="text" class="form-control" id="subscriberId" name="subscriberId">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal form to create new subscriber -->
    <div class="modal fade" id="createSubscriberModal" tabindex="-1" aria-labelledby="createSubscriberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createSubscriberModalLabel">Create Subscriber</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createSubscriberForm">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.semanticui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#createSubscriberBtn').click(function() {
                // Load the create subscriber modal form HTML
                $('#createSubscriberModal', function(data) {
                    // Add the modal form HTML to the page
                    $('body').append(data);

                    // Show the modal
                    $('#createSubscriberModal').modal('show');
                    $('#createSubscriberForm').attr('action', '/createSubscribers');
                })
            });

            // Add event listener for form submission
            $('#createSubscriberForm').submit(function(e) {
                e.preventDefault();
                // Make an AJAX POST request to submit the form data...
                var form = $(this);
                console.log("This the Form :" + form);
                var formData = form.serialize();
                console.log("This the Form Data:" + formData);
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle success response
                        console.log('Subscriber created successfully!');
                        // Reload the page
                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error response
                        console.log('Failed to create subscriber: ' + errorThrown);
                    }
                });
            });






            $('#subscribersTable tbody').on('click', 'a.edit-subscriber', function() {

                var subscriberData = $('#subscribersTable').DataTable().row($(this).parents('tr')).data();

                // Populate the form fields with subscriber data
                $('#editSubscriberModal input[name=email]').val(subscriberData.email);
                $('#editSubscriberModal input[name=subscriberId]').val(subscriberData.subscriberId);
                $('#editSubscriberModal input[name=name]').val(subscriberData.name);
                $('#editSubscriberModal input[name=country]').val(subscriberData.country);

                // Set the form action URL
                $('#editSubscriberForm').attr('action', '/fetchUpdateSubscribers');

                // Show the modal
                $('#editSubscriberModal').modal('show');
            });

            $('#editSubscriberForm').submit(function(e) {
                e.preventDefault();
                // Make an AJAX POST request to submit the form data
                var form = $(this);
                console.log("This the Form :" + form);
                var formData = form.serialize();
                console.log("This the Form Data:" + formData);

                //Make the POST request to the server
                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(requestBody) {
                        console.log("successful: " + JSON.stringify(requestBody));
                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Display an error message
                        alert('Failed to Update Subscriber: ' + textStatus + ' - ' + errorThrown);
                        window.location.reload();
                    }
                });
            });

            //go in the button class delete-subscriber get the attribute id so it sends the correct subscriber
            $('#subscribersTable').on('click', 'button.delete-subscriber', function() {
                var subscriberId = $(this).data('id');
                console.log((subscriberId));

                $.ajax({

                    url: '/fetchDeleteSubscribers',
                    method: 'DELETE',
                    data: {
                        subscriberId: subscriberId
                    },
                    success: function(response) {

                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Failed to delete subscriber. ' + textStatus + ' - ' + errorThrown);
                    }

                });

            });


            $('#subscribersTable').DataTable({
                ajax: {
                    url: '/subscribersList',
                    dataSrc: 'data',

                },
                pageLength: 5,
                lengthMenu: [5, 10, 15, 100],
                columns: [{
                        data: 'subscriberId',
                        "visible": false,
                    }, {

                        data: 'email',
                        render: function(data, type, row, meta) {
                            return '<a href="#" class="edit-subscriber" data-id=>' + data + '</a>';
                        }

                    },

                    {
                        data: 'name'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'date_subscribe'
                    },
                    {
                        data: 'date_created'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return '<button class="delete-subscriber btn btn-danger" data-id="' +
                                row.subscriberId + '">Delete</button>';
                        }
                    }

                ],

            });
        });
    </script>
</body>

</html>
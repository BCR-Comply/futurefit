$('#admin-users-datatable').DataTable({
    serverSide: true,
    responsive: true,
    select: true,
    "processing": true,
    "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },
    ajax: {
        url: "{{route('user')}}"
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'firstname', name: 'firstname'},
        {data: 'lastname', name: 'lastname'},
        {data: 'email', name: 'email'},
        {data: 'usertype', name: 'usertype'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});


$('#surveyor-users-datatable').DataTable({
    serverSide: true,
    responsive: true,
    select: true,
    "processing": true,
    "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },
    ajax: {
        url: "{{route('surveyor')}}"
    },
    columns: [
        {data: 'user_id', name: 'user_id'},
        {data: 'full_name', name: 'full_name'},
        {data: 'email', name: 'email'},
        {data: 'phone_number', name: 'phone_number'},
        {data: 'appname', name: 'appname'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});


$('#clients-datatable').DataTable({
    serverSide: true,
    responsive: true,
    select: true,
    "processing": true,
    "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },
    ajax: {
        url: "{{route('client')}}"
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'type', name: 'type'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'phone', name: 'phone'},
        {data: 'address', name: 'address', searchable: false},
        // {data: 'address2', name: 'address2'},
        // {data: 'address3', name: 'address3'},
        {data: 'notes', name: 'notes'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});


$('#projects-datatable').DataTable({
    serverSide: true,
    responsive: true,
    select: true,
    "processing": true,
    "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },
    ajax: {
        url: "{{route('project')}}"
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'client_id', name: 'client_id', orderable: false},
        {data: 'our_ref', name: 'our_ref'},
        {data: 'batch', name: 'batch'},
        {data: 'type', name: 'type', orderable: false, searchable: false},
        {data: 'quote', name: 'quote'},
        {data: 'project_complete', name: 'project_complete'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

$('#properties-datatable').DataTable({
    serverSide: true,
    responsive: true,
    select: true,
    "processing": true,
    "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },
    ajax: {
        url: "{{route('property')}}"
    },
    columns: [
        {data: 'id', name: 'id'},
        {data: 'type', name: 'type', orderable: false, searchable: false},
        {data: 'our_ref', name: 'our_ref', orderable: false, searchable: false},
        {data: 'batch', name: 'batch', orderable: false, searchable: false},
        {data: 'client_id', name: 'client_id', orderable: false},
        {data: 'address1', name: 'address1'},
        {data: 'date_added', name: 'date_added'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

$('.role-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            "class" : "td-actions text-right",  
        },
    ]
});

//  Select all function for role create and edit
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
} 
//  Main Service index table
$('.main-service-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'code', name: 'code'},
        {data: 'is_active', name: 'is_active'},
        {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            "class" : "td-actions text-right",  
        },
    ]
});

//  Category index table
$('.category-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'main_service', name: 'main_service'},
        {data: 'code', name: 'code'},
        {data: 'is_active', name: 'is_active'},
        {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            "class" : "td-actions text-right",  
        },
    ]
});

//  User index table
$('.user-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'role', name: 'role'},
        {data: 'email', name: 'email'},
        {data: 'is_active', name: 'is_active'},
        {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            "class" : "td-actions text-right",  
        },
    ]
});


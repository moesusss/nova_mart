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

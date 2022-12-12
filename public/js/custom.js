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


//  Sub Category index table
$('.sub-category-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'category', name: 'category'},
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

//  Brand index table
$('.brand-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'sub_category', name: 'sub_category'},
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

//  Hub Vendor index table
$('.hub-vendor-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'main_service', name: 'main_service'},
        {data: 'email', name: 'email'},
        {data: 'mobile', name: 'mobile'},
        {data: 'address', name: 'address'},
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

//  Vendor index table
$('.vendor-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'hub_vendor', name: 'hub_vendor'},
        {data: 'email', name: 'email'},
        {data: 'mobile', name: 'mobile'},
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


//  Vendor index table
$('.item-data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#table_url').attr('data-table-url'),
    columns: [
        {data: 'name', name: 'name'},
        {data: 'sub_category', name: 'sub_category'},
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

//Date and time picker
$('#opening_time').datetimepicker({ 
    icons: { time: 'far fa-clock' },
    format: 'LT',
    ignoreReadonly: true
});

//Date and time picker
$('#closing_time').datetimepicker({ 
    icons: { time: 'far fa-clock' },
    format: 'LT' 
});


//  Image Upload
$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });    
    
//  Google Map
$('#originMap').on('show.bs.modal', function (event) {
    var map_options = {
        center: new google.maps.LatLng(16.8409, 96.1735),
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map_canvas"), map_options);

    var input = document.getElementById("keyword");
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo("bounds", map);

    var marker = new google.maps.Marker({map: map});

    google.maps.event.addListener(autocomplete, "place_changed", function()
    {
        var place = autocomplete.getPlace();
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        }
        else {
            map.setCenter(place.geometry.location);
            map.setZoom(15);
        }
        marker.setPosition(place.geometry.location);
        $('#origin_address').val(place.name);
        $('#address').val(place.name);
        $('#lat').val(place.geometry.location.lat());
        $('#lng').val(place.geometry.location.lng());
    });

    google.maps.event.addListener(map, "click", function(event) {
        marker.setPosition(event.latLng);
    });
})

function initialize() {
}
// google.maps.event.addDomListener(window, 'load', initialize);
//  record delete
$(document).on('click','.destroy_btn',function(){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            var form_id = $(this).attr('data-origin');
            $('#'+form_id).submit();
        } else {
            // swal("Your imaginary file is safe!");
        }
    });
});

//  Get Sub Categories using category 
$(document).on('change','.category_id',function(){
    category_id = $(this).val();
    url = $(this).attr('data-attr-url')+'/'+category_id;
    $.ajax({
		url: url,
		type: "GET",
		success: function(data) {
            console.log(data);
            if(data.status == true){
                option = "<option value=''>Select Sub Category</option>";
                $.each(data.data, function(index, value) {
                        option += '<option value="'+value.id+'">'+value.name+'</option>';
                    
                });
                $("#sub_category_id").html(option);
            }
		}
	});
})


//  Get Brand using sub category 
$(document).on('change','.sub_category_id',function(){
    sub_category_id = $(this).val();
    url = $(this).attr('data-attr-url')+'/'+sub_category_id;
    $.ajax({
		url: url,
		type: "GET",
		success: function(data) {
            if(data.status == true){
                option = "<option value=''>Select Brand</option>";
                $.each(data.data, function(index, value) {
                        option += '<option value="'+value.id+'">'+value.name+'</option>';
                    
                });
                $("#brand_id").html(option);
            }
		}
	});
})

 //  Image multiple upload
 var previewImages = function(input, imgPreviewPlaceholder) {
    if (input.files) {
        var filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
        var reader = new FileReader();
        reader.onload = function(event) {
        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
        }
        reader.readAsDataURL(input.files[i]);
        }
    }
};
    $('#images').on('change', function() {
    previewImages(this, 'div.images-preview-div');
});





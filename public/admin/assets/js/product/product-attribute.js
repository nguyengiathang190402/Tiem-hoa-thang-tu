$('.select2').select2();
// $(document).ready(function () {
//     $('#attributeSelect').on('change', function () {
//         var selectedAttributeId = $(this).val();
//         $('#selectedAttributeId').val(selectedAttributeId);
//     });
// });
// $(document).ready(function () {
//     $('.attribute-select').change(function () {
//         const selectedAttributeId = $(this).val();
//         const valueSelectContainer = $(this).closest('.attribute-value-row').find('.value-select-container');

//         // Xóa các select element giá trị cũ
//         valueSelectContainer.empty();

//         if (selectedAttributeId) {
//             // Tạo select element giá trị mới
//             const valueSelect = $('<select class="col-4 select2 value-select" name="selected_attribute_values[' + selectedAttributeId + '][]" multiple></select>');
//             valueSelect.append('<option value="" disabled>-- Chọn giá trị --</option>');
//             // Sử dụng AJAX để lấy dữ liệu giá trị tương ứng với thuộc tính đã chọn
//             $.get(`/get-values/${selectedAttributeId}`, function (data) {
//                 $.each(data, function (index, value) {
//                     valueSelect.append('<option value="' + value.id + '">' + value.value + '</option>');
//                 });
//                 valueSelectContainer.append(valueSelect);
//                 valueSelect.select2();
//             }).fail(function (error) {
//                 console.error("Error fetching data: ", error);
//             });
//         }
//     });

//     $(document).ready(function () {
//         $('.add-attribute-value').click(function (e) {
//             e.preventDefault();
    
//             // Gọi AJAX để lấy dữ liệu thuộc tính
//             $.get('/get-attribute-data', function (data) {
//                 const attributeOptions = data.map(attribute => {
//                     return `<option value="${attribute.id}">${attribute.name}</option>`;
//                 }).join('');
    
//                 // Tạo đoạn mã HTML mới cho hàng
//                 const newRow = `
//                     <div class="attribute-value-row">
//                         <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger" for="attributeSelect">Chọn thuộc tính:</label>
//                         <select class="col-4 select2 attribute-select" name="selected_attributes[]" id="attributeSelect">
//                             <option value="" disabled>-- Chọn thuộc tính --</option>
//                             ${attributeOptions}
//                         </select>
                        
//                         <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger" for="valueSelect">Chọn giá trị:</label>
//                         <span class=" value-select-container" id="valueSelectContainer">
//                             <!-- Các tùy chọn giá trị sẽ được thêm vào đây -->
//                         </span>
                        
//                         <button class="btn btn-danger remove-row">Xóa</button>
//                     </div>
//                 `;
    
//                 // Thêm hàng mới vào phần chứa các hàng về thuộc tính và giá trị
//                 $('#attributeValueRows').append(newRow);
    
//                 // Khởi tạo Select2 cho các dropdown mới thêm
//                 $('.attribute-select:last').select2();
//                 // Xử lý xóa dòng
//                 $(document).on('click', '.remove-row', function (e) {
//                     e.preventDefault();
//                     $(this).closest('.attribute-value-row').remove();
//                 });
//             });
//         });
    
//         // ...
//     });    

//     function generateAttributeOptions() {
//         let options = '';
//         attributesData.forEach(attribute => {
//             options += `<option value="${attribute.id}">${attribute.name}</option>`;
//         });
//         return options;
//     }
// });
$(document).ready(function () {
    

    $(document).ready(function () {
        $('.add-attribute-value').click(function (e) {
            e.preventDefault();
    
            // Gọi AJAX để lấy dữ liệu thuộc tính
            $.get('/get-attribute-data', function (data) {
                const attributeOptions = data.map(attribute => {
                    return `<option value="${attribute.id}">${attribute.name}</option>`;
                }).join('');
    
                // Tạo đoạn mã HTML mới cho hàng
                const newRow = `
                    <div class="attribute-value-row">
                        <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger" for="attributeSelect">Chọn thuộc tính:</label>
                        <select class="col-4 select2 attribute-select" name="selected_attributes[]" id="attributeSelect">
                            <option value="" disabled>-- Chọn thuộc tính --</option>
                            ${attributeOptions}
                        </select>
                        
                        <label class="text-center text-uppercase text-secondary text-s font-weight-bolder text-danger" for="valueSelect">Chọn giá trị:</label>
                        <span class="value-select-container" id="valueSelectContainer">
                        
                        </span>
                        
                        <button class="btn btn-danger remove-row">Xóa</button>
                    </div>
                `;
    
                // Thêm hàng mới vào phần chứa các hàng về thuộc tính và giá trị
                $('#attributeValueRows').append(newRow);
    
                // Khởi tạo Select2 cho các dropdown mới thêm
                $('.attribute-select:last').select2();
            });
        });
    
        // Xử lý sự kiện thay đổi thuộc tính để tải giá trị tương ứng
        $(document).on('change', '.attribute-select', function () {
            const selectedAttributeId = $(this).val();
            const valueSelectContainer = $(this).closest('.attribute-value-row').find('.value-select-container');
            if (selectedAttributeId) {
                // Tạo select element giá trị mới
                const valueSelect = $('<select class="col-4 select2 value-select" name="selected_attribute_values[' + selectedAttributeId + '][]" multiple></select>');
                valueSelect.append('<option value="" disabled>-- Chọn giá trị --</option>');
                // Sử dụng AJAX để lấy dữ liệu giá trị tương ứng với thuộc tính đã chọn
                $.get(`/get-values/${selectedAttributeId}`, function (data) {
                    $.each(data, function (index, value) {
                        valueSelect.append('<option value="' + value.id + '">' + value.value + '</option>');
                    });
                    valueSelectContainer.append(valueSelect);
                    valueSelect.select2();
                }).fail(function (error) {
                    console.error("Error fetching data: ", error);
                });
            }
            // Gọi AJAX để lấy dữ liệu giá trị của thuộc tính
            $.get(`/get-values/${selectedAttributeId}`, function (data) {
                const valueOptions = data.map(value => {
                    return `<option value="${value.id}">${value.value}</option>`;
                }).join('');
    
                // Tạo đoạn mã HTML cho dropdown giá trị
                const valueSelectHtml = `
                    <select class="col-4 select2 value-select" name="selected_attribute_values[${selectedAttributeId}][]" multiple>
                        ${valueOptions}
                    </select>
                `;
                // Thay thế nội dung của phần chứa giá trị bằng đoạn mã HTML mới
                valueSelectContainer.html(valueSelectHtml);
    
                // Khởi tạo Select2 cho dropdown giá trị mới
                valueSelectContainer.find('.value-select').select2();
            });
        });
    
        // Khởi tạo Select2 cho dropdown thuộc tính và giá trị ban đầu
        $('.attribute-select').select2();
        $('.value-select').select2();
    });

    // Xử lý xóa dòng
    $(document).on('click', '.remove-row', function (e) {
        e.preventDefault();
        $(this).closest('.attribute-value-row').remove();
    });
});



const valueSelect = $('#valueSelect');

// Chọn thuộc tính
// $('.attribute-select').change(function () {
//     const selectedAttributeId = $(this).val();

//     if (selectedAttributeId) {
//         $.get(`/get-values/${selectedAttributeId}`, function (data) {
//             valueSelect.empty();
//             if (data.length === 0) {
//                 valueSelect.append('<option value="" disabled>-- Chưa có giá trị --</option>');
//                 valueSelect.prop('disabled', true);
//             } else {
//                 valueSelect.append('<option value="" disabled>-- Chọn giá trị --</option>');
//                 $.each(data, function (index, value) {
//                     valueSelect.append('<option value="' + value.id + '">' + value.value + '</option>');
//                 });
//                 valueSelect.prop('disabled', false);
//             }
//             valueSelect.select2();
//         }).fail(function (error) {
//             console.error("Error fetching data: ", error);
//         });
//     } else {
//         valueSelect.empty().append('<option value="" disabled>-- Chọn giá trị --</option>');
//         valueSelect.prop('disabled', true);
//         valueSelect.select2();
//     }
// });
$(document).ready(function() {
    let i = 0 
    // Add the first product row by default
    let firstProductRow = $('#product-template').clone();
    firstProductRow.removeAttr('style');
    $('#inputContainer').append(firstProductRow);
 
    
   $('.add-product').on('click', function() {
        let newProductRow = $('#product-template').clone();
        newProductRow.removeAttr('style');
        $('#inputContainer').append(newProductRow);
        i++
        // Optionally, add event listeners to newly added rows
        newProductRow.find('.remove-product').on('click', function() {
            newProductRow.remove(); 
            
        });

    });
if(i<=0){alert("yfz")}else{
    // Remove the product row
    $(document).on('click', '.remove-product', function() {
        $(this).closest('.product-row').remove();
        i--
    });}
});

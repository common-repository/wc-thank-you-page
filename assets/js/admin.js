;(function($){

    // Tabs
    $(document).ready(function() {


        // Have the previously selected tab open
        if (sessionStorage.activeTab) {

            $('.WPTE-thankyou-tab-content ' + sessionStorage.activeTab).show().siblings().hide();
            $(".WPTE-thankyou-tab-button li a[href=" + "\"" + sessionStorage.activeTab + "\"" + "]").parent().addClass('active').siblings().removeClass('active');
        
        }
        
        // Enable, disable and switch tabs on click
        $('.WPTE-thankyou-tab-button > .btn > a').on('click', function(e)  {

            e.preventDefault();

            var currentAttrValue = $(this).attr('href');
            var activeTab = $(this).attr('href');

            if(activeTab.length){
                 
                // Show/Hide Tabs
                $('.WPTE-thankyou-tab-content ' + currentAttrValue).fadeIn('fast').siblings().hide();
                sessionStorage.activeTab = currentAttrValue;

                $(this).parent('li').addClass('active').siblings().removeClass('active');
               
              }

        }); 

    });
   
    // Select 2
    $(document).ready(function() {

        //Select 2 options
        $('.WPTE-thank-you-page-select').select2();

        // Checkbox Dependency
        
        if($('#WPTE_thankyou_custom_checkbox[type="checkbox"]').prop("checked") == true){

            $('#WPTE_thankyou_page_url').show();
            $('#WPTE_thankyou_page_select').hide();

        }

        $('#WPTE_thankyou_custom_checkbox[type="checkbox"]').click(function(){

            if($(this).prop("checked") == true){

                $('#WPTE_thankyou_page_url').show();
                $('#WPTE_thankyou_page_select').hide();

            }
            else if($(this).prop("checked") == false){

                $('#WPTE_thankyou_page_url').hide();
                $('#WPTE_thankyou_page_select').show();

            }
        });
      
    });

    // WooCommerce Product Tabs
    setTimeout(function(){  $(".WPTE_options_group").show(); }, 3000);

})(jQuery);




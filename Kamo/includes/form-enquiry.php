<div id="success_message" class="alert alert-primary" style="display:none"></div>
<form id="enquiry">
    <h4>Send an Enquiry about <?php the_title();?></h4>
    <input type="hidden" name="registration" value="<?php the_field('registration');?>">
    <div class="form-group row">
        <div class="col-lg-6">
            <label for="name">First Name</label>
            <input type="text" name="fname" placeholder="First Name" class="form-control fw-lighter" required>
        </div>
        <div class="col-lg-6">
            <label for="name">Last Name</label>
            <input type="text" name="lname" placeholder="Last Name" class="form-control fw-lighter" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <label for="name">Email</label>
            <input type="email" name="email" placeholder="Email Addres" class="form-control fw-lighter" required>
        </div>
        <div class="col-lg-6">
            <label for="name">Phone</label>
            <input type="tel" name="phone" placeholder="Phone" class="form-control fw-lighter" required>
        </div>
    </div>
    <div class="form-group">
        <label for="name">Message</label>
         <textarea name="enquiry"  placeholder="Your Enquiry" class="form-control fw-lighter" required></textarea>
    </div>
    <div class="form-group py-2">
        <button type="submit" class="btn btn-primary btn-sm col-12 mx-auto">Send your enquiry</button>
    </div>

</form>

<script>
    (function($){
        
        $('#enquiry').submit( function(event){
            event.preventDefault();
            var endpoint = '<?php echo admin_url('admin-ajax.php');?>';
            var form = $('#enquiry').serialize();
            var formdata = new FormData;
            formdata.append('action', 'enquiry');
            formdata.append('enquiry', form);

            $.ajax(endpoint, {
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,

                success: function(res) {
                   $('#enquiry').fadeOut(200);
                     $('#success_message').text('Your enquiry has been sent successfully').show();
                     $('#enquiry').trigger('reset');
                     $('#enquiry').fadeIn(500);
                },
                error: function(err) {
                    
                },
            })



        });
        
    })(jQuery);
</script>

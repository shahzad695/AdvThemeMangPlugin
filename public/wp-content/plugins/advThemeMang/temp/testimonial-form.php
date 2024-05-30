<form action="" class="sunsetform" method="post" data-url="<?php echo admin_url('admin-ajax.php') ?>">
    <div class="sunsetform__field-cont"><label for="name"></label> <input class="sunsetform__field sunsetform__field--input" id="name"
            name="name" type="text" placeholder="Your Name" />
        <!-- <small class=" sunsetform__msg ">Your Name is Required</small> -->
        <span class="sunsetform__msg sunsetform__msg--invalid"></span>
    </div>

    <div class="sunsetform__field-cont"><label for="email"></label> <input class="sunsetform__field sunsetform__field--input" id="email"
            name="email" type="email" placeholder="Your Email" />
        <!-- <small class="sunsetform__msg ">Your Email is Required</small> -->
        <span class="sunsetform__msg sunsetform__msg--invalid"></span>
    </div>

    <div class="sunsetform__field-cont"><label for="message"></label> <textarea class="sunsetform__field sunsetform__field--input"
            id="message" name="message" rows="5" placeholder="Your Massage" maxlength="65525"></textarea>
        <!-- <small class="sunsetform__msg ">A Message is Required</small> -->
        <span class="sunsetform__msg sunsetform__msg--invalid sunsetform__msg--invalid--msg"></span>
    </div>

    <div class="sunsetform__field-cont"><button type="submit" class="sunsetform__field sunsetform__field--btn">Submit</button>
        <small class="sunsetform__msg sunsetform__msg--progress">Message submission in progress</small>
        <small class="sunsetform__msg sunsetform__msg--success">Message succesfully submitted</small>
        <small class="sunsetform__msg sunsetform__msg--failure">Unable to Submit Message try again latter</small>
    </div>
    <!-- <input type="hidden" name="action" value="testimonial_form_submit"> -->

</form>
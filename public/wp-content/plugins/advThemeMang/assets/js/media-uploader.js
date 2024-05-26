export default class MediaUploader {
    constructor() {
        this.imageUploaderBtn = document.querySelector(".js-image-uploader");
        this.imageUploaderval = document.querySelector(".upload-image");
    //    this.imageUploadBtn=document.getElementById('widget-image-uploader');
        // this.imageUploaderprev = document.querySelector("#profile_picture_preview");
        // this.formSubmitBtn = document.querySelector(".form-overview");
       this.mediauploader;
      this.events();
    }
    events(){
        
        // addEventListener('load', function(e) { PR.prettyPrint(); }, false);
        document.addEventListener('DOMContentLoaded',(e)=>{
            console.log(this.imageUploaderBtn,'events ran');
            document.addEventListener("click", (e) => {
                if (e.target && e.target.id === 'widget-image-uploader') {
                   
                    // e.preventDefault();
                    this.mediaUploader(e);
                }
                // console.log(this.imageUploaderBtn,'clicked on image upload');
                // e.preventDefault();
                // this.mediaUploader
            }); 
            
        })
       
      
        // console.log(this.imageUploaderBtn,'events ran');
    }
    
   mediaUploader(e) {
    
    this.imageUploaderval = document.querySelector(".upload-image");
    let widgetForm = e.target.closest('.widget-content');
            // console.log(this.imageUploaderval);
            e.preventDefault();
            // console.log('clicked on image upload');

            if (this.mediauploader) {
                this.mediauploader.open();
                return;
            }
            
            // = wp.media.frames.file_frame
            this.mediauploader = wp.media({
                title: "Select media uploader Image",
                button: {
                text: "Select Image",
                },
                multiple: false,
            });
            this.mediauploader.on("select", (e) => {
                
                let attachment = this.mediauploader.state().get("selection").first().toJSON();
                const url = attachment.url;
                
            if (widgetForm) {
                var widgetInput = widgetForm.querySelector('input[id*="image"]');
                if (widgetInput) {
                    widgetInput.value = url;
                    console.log('Value set to input field');
                } else {
                    console.log('Input field not found');
                }
            } else {
                console.log('Widget form not found');
            }
                // console.log(url);
                // this.imageUploaderval.value = url;
                // console.log(this.imageUploaderval);
                // imageUploaderprev.style.backgroundImage = `url(${attachment.url})`;
                // this.imageUploaderval.value = attachment.url;
            });

            this.mediauploader.open();
};
// imageUploaderRemove.addEventListener("click", (e) => {
//   e.preventDefault();
//   let answer = confirm("Are you sure you want to remove the profile picture");

//   if (answer == true) {
//     imageUploaderval.value = "";
//     formSubmitBtn.submit();
//   }
//   return;
// });

    }






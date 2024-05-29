import 'code-prettify'
import AdminTabs from "./admin-tabs";
import MediaUploader from "./media-uploader";
import Form from "./form";

document.addEventListener("DOMContentLoaded", (e) => {
    new Form();
});

new AdminTabs();
new MediaUploader();

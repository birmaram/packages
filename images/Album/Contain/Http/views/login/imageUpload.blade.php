
@section('page-content')
<script type="text/javascript">
window.onboardX = {
  'obx_domain' : 'onboardx.com', //don't change
  'app': 'HthtKn', //don't change
  'type':'visitor' //don't change
};
(function(){function c(){var b=d.createElement("script");b.type="text/javascript";b.async=!0;b.src="//onboardx.com/embed/obx.js";var a=d.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)}var a=window,d=document;a.attachEvent?a.attachEvent("onload",c):a.addEventListener("load",c,!1)})();
</script>
  @include("login.contents.imageUpload")
@endsection


@section('footer-script')
<script>
  function uploadFilePopup(event){
    event.preventDefault();
    $("#org_logo").trigger('click');
  }
</script>
@endsection

<!--Start of Google Analytics Script-->
<script type="text/javascript">
  // Detect the current domain
  var currentDomain = window.location.hostname;
  var trackingId;

  // Choose the tracking ID based on the detected domain using regular expressions
  if (/cultura.gov.br$/.test(currentDomain)) {
      trackingId = 'G-LNKQ9P7JDK';
  } else if (/funarte.gov.br$/.test(currentDomain)) {
      trackingId = 'G-LNKQ9P7JDK';
  } else {
      // Fallback or default tracking ID
      trackingId = 'G-LNKQ9P7JDK';
  }

  // Dynamically load the analytics.js script
  var scriptElement = document.createElement('script');
  scriptElement.async = 1;
  scriptElement.src = `https://www.googletagmanager.com/gtag/js?id=${trackingId}`;

  var firstScript = document.getElementsByTagName('meta')[0];
  firstScript.parentNode.insertBefore(scriptElement, firstScript);

  // Dynamically config the analytics script
  window.dataLayer = window.dataLayer || [];
  function gtag(){
      dataLayer.push(arguments);
  }

  gtag('js', new Date());
  gtag('config', trackingId);
</script>
<!--End of Google Analytics Script-->

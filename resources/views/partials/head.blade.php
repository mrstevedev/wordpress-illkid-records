<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php wp_head() @endphp
  @if(!is_front_page()) 
    <link rel="preload" as="font" href="@php bloginfo('url') @endphp/wp-content/themes/illkidrecords/dist/fonts/HelveticaNeueBlackCond.woff" type="font/woff" crossorigin />
    <link rel="preload" as="font" href="@php bloginfo('url') @endphp/wp-content/themes/illkidrecords/dist/fonts/HelveticaNeueBlackCond.woff2" type="font/woff" crossorigin />
    <link rel="preload" as="font" href="@php bloginfo('url') @endphp/wp-content/themes/illkidrecords/dist/fonts/HelveticaNeueBold.woff" type="font/woff" crossorigin />
    <link rel="preload" as="font" href="@php bloginfo('url') @endphp/wp-content/themes/illkidrecords/dist/fonts/HelveticaNeueBold.woff2" type="font/woff" crossorigin />
    <link rel="preload" as="font" href="@php bloginfo('url') @endphp/wp-content/themes/illkidrecords/dist/fonts/HelveticaNeueMedium.woff" type="font/woff" crossorigin />
    <link rel="preload" as="font" href="@php bloginfo('url') @endphp/wp-content/themes/illkidrecords/dist/fonts/HelveticaNeueMedium.woff2" type="font/woff" crossorigin />
  @endif

  <link rel="stylesheet" href="https://use.typekit.net/nlf5xci.css">

    @if(is_front_page()) 
      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @endif
    <script src="https://kit.fontawesome.com/42562b750b.js" crossorigin="anonymous"></script>
  </head>

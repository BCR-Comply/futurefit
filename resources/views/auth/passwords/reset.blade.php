@extends('layouts.app')

@section('content')
<style>
    .card-header{
        background-color: #EAF1FF !important;
    }
    .navbar.navbar-expand-md.navbar-light.shadow-sm.bg-navy,button.btn._btn-primary.btn-block{
        background-color: #1A47A3 !important;
    }
    .btn.btn-link.text-center.text-decoration-none{
        color: #1A47A3 !important;
    }
    .w-55{
        width: 55% !important;
    }
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card _shadow-1">
                    <div class="card-header text-center bg-navy p-4">

                        <div class="p-1">
                            <svg class="w-55" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1110 502"><defs><style>.cls-1{fill:#1a47a3;}.cls-2{fill:#fff;}.cls-3{fill:url(#linear-gradient);}.cls-4{fill:url(#linear-gradient-2);}.cls-5{fill:url(#linear-gradient-3);}.cls-6{fill:url(#linear-gradient-4);}.cls-7{fill:url(#linear-gradient-5);}.cls-8{fill:url(#linear-gradient-6);}.cls-9{fill:url(#linear-gradient-7);}.cls-10{fill:url(#linear-gradient-8);}.cls-11{fill:url(#linear-gradient-9);}.cls-12{fill:url(#linear-gradient-10);}.cls-13{fill:url(#linear-gradient-11);}.cls-14{opacity:0.5;fill:url(#radial-gradient);}</style><linearGradient id="linear-gradient" x1="136.75" y1="248.86" x2="136.75" y2="53.63" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#009ddc"/><stop offset="1" stop-color="#67b8e7"/></linearGradient><linearGradient id="linear-gradient-2" x1="337.35" y1="248.86" x2="337.35" y2="53.63" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-3" x1="548.1" y1="248.86" x2="548.1" y2="53.63" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-4" x1="80.36" y1="255.11" x2="80.36" y2="411.83" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e06c6d"/><stop offset="1" stop-color="#d5244c"/></linearGradient><linearGradient id="linear-gradient-5" x1="186" y1="255.11" x2="186" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-6" x1="323.91" y1="255.11" x2="323.91" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-7" x1="463.79" y1="255.11" x2="463.79" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-8" x1="538.16" y1="255.11" x2="538.16" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-9" x1="608.37" y1="255.11" x2="608.37" y2="411.83" xlink:href="#linear-gradient-4"/><linearGradient id="linear-gradient-10" x1="718.64" y1="163.48" x2="970.1" y2="163.48" xlink:href="#linear-gradient"/><linearGradient id="linear-gradient-11" x1="703.18" y1="192.17" x2="1075.38" y2="192.17" xlink:href="#linear-gradient-4"/><radialGradient id="radial-gradient" cx="790.05" cy="189.79" r="37.92" gradientTransform="translate(0 314.58) scale(1 0.2)" gradientUnits="userSpaceOnUse"><stop offset="0"/><stop offset="1" stop-opacity="0"/></radialGradient></defs><rect class="cls-1" x="702.75" y="371.65" width="373.19" height="89.85" rx="10.89"/><path class="cls-2" d="M816.85,437.89a1.21,1.21,0,0,1-.13.6,1,1,0,0,1-.62.41,6.32,6.32,0,0,1-1.43.23c-.63,0-1.49.06-2.57.06-.91,0-1.64,0-2.18-.06a5,5,0,0,1-1.29-.25,1.41,1.41,0,0,1-.67-.45,2.45,2.45,0,0,1-.32-.67l-3.78-9.41c-.46-1.07-.9-2-1.34-2.84a8.94,8.94,0,0,0-1.45-2.06,5.13,5.13,0,0,0-1.84-1.26,6.4,6.4,0,0,0-2.41-.42h-2.67v16.06a.9.9,0,0,1-.21.58,1.35,1.35,0,0,1-.7.42,7.1,7.1,0,0,1-1.3.27,24.08,24.08,0,0,1-4.16,0,7.19,7.19,0,0,1-1.32-.27,1.28,1.28,0,0,1-.68-.42.94.94,0,0,1-.19-.58V399.55a2.58,2.58,0,0,1,.73-2.06,2.64,2.64,0,0,1,1.81-.64H799c1.1,0,2,0,2.73.07s1.37.09,2,.16a17.57,17.57,0,0,1,4.57,1.24,11,11,0,0,1,3.46,2.29,9.7,9.7,0,0,1,2.16,3.36,12.23,12.23,0,0,1,.75,4.44,13,13,0,0,1-.54,3.86,9.52,9.52,0,0,1-1.58,3.11,10.11,10.11,0,0,1-2.57,2.38,13.61,13.61,0,0,1-3.48,1.63,9.32,9.32,0,0,1,3.33,2.69,15.74,15.74,0,0,1,1.39,2.11,28.47,28.47,0,0,1,1.27,2.69l3.55,8.31c.32.82.54,1.43.65,1.8A3.41,3.41,0,0,1,816.85,437.89Zm-11-28.6a6.21,6.21,0,0,0-.94-3.51,5.11,5.11,0,0,0-3.1-2,10.73,10.73,0,0,0-1.48-.26,19.57,19.57,0,0,0-2.3-.1h-3.84v12h4.37a10.55,10.55,0,0,0,3.19-.44,6.24,6.24,0,0,0,2.28-1.24,5.06,5.06,0,0,0,1.37-1.9A6.56,6.56,0,0,0,805.81,409.29Z"/><path class="cls-2" d="M848.51,422.52a3.13,3.13,0,0,1-.67,2.21,2.37,2.37,0,0,1-1.84.72H828.32a11.81,11.81,0,0,0,.44,3.37,6.35,6.35,0,0,0,1.4,2.57,5.94,5.94,0,0,0,2.47,1.61,10.59,10.59,0,0,0,3.64.56,20,20,0,0,0,3.77-.31,25.57,25.57,0,0,0,2.82-.68c.79-.25,1.45-.48,2-.69a3.6,3.6,0,0,1,1.27-.31.91.91,0,0,1,.49.12.85.85,0,0,1,.33.4,3.36,3.36,0,0,1,.18.83c0,.36,0,.81,0,1.36s0,.88,0,1.22a6.19,6.19,0,0,1-.1.86,2.12,2.12,0,0,1-.19.6,2.43,2.43,0,0,1-.34.47,3.77,3.77,0,0,1-1.16.62,18.23,18.23,0,0,1-2.41.77c-1,.25-2.1.46-3.35.65a28.58,28.58,0,0,1-4,.28,21.37,21.37,0,0,1-6.79-1,12.06,12.06,0,0,1-4.87-3,12.3,12.3,0,0,1-2.92-5,23.59,23.59,0,0,1-1-7.1,22.73,22.73,0,0,1,1-7,14.58,14.58,0,0,1,2.93-5.27,12.52,12.52,0,0,1,4.68-3.31,16,16,0,0,1,6.2-1.14,16.21,16.21,0,0,1,6.24,1.08,11.25,11.25,0,0,1,4.25,3,11.94,11.94,0,0,1,2.44,4.51,19.61,19.61,0,0,1,.78,5.66Zm-7.94-2.35a8.43,8.43,0,0,0-1.39-5.42,5.37,5.37,0,0,0-4.58-2,5.83,5.83,0,0,0-2.72.59,5.56,5.56,0,0,0-1.92,1.57,7.29,7.29,0,0,0-1.17,2.35,11.56,11.56,0,0,0-.47,2.88Z"/><path class="cls-2" d="M872,435a10.19,10.19,0,0,1-.18,2.2,2.49,2.49,0,0,1-.47,1.08,2.72,2.72,0,0,1-.87.55,7.46,7.46,0,0,1-1.33.42,12.9,12.9,0,0,1-1.67.28,15.39,15.39,0,0,1-1.8.1,13.12,13.12,0,0,1-4.24-.62,7,7,0,0,1-3-1.91,7.87,7.87,0,0,1-1.73-3.24,17,17,0,0,1-.55-4.62V414.37h-3.49c-.41,0-.72-.25-.94-.76a7,7,0,0,1-.33-2.56,11.78,11.78,0,0,1,.09-1.59,3.64,3.64,0,0,1,.24-1,1.17,1.17,0,0,1,.41-.54,1,1,0,0,1,.57-.16h3.45v-6.48a1,1,0,0,1,.18-.59,1.34,1.34,0,0,1,.65-.44,5.39,5.39,0,0,1,1.27-.26c.53,0,1.19-.08,2-.08s1.47,0,2,.08a5.18,5.18,0,0,1,1.26.26,1.51,1.51,0,0,1,.65.44,1,1,0,0,1,.19.59v6.48h6.32a1,1,0,0,1,.57.16,1.17,1.17,0,0,1,.41.54,3.64,3.64,0,0,1,.24,1,11.78,11.78,0,0,1,.09,1.59,7,7,0,0,1-.33,2.56c-.22.51-.53.76-.94.76h-6.36V428a6.78,6.78,0,0,0,.75,3.57,2.91,2.91,0,0,0,2.67,1.19,5.29,5.29,0,0,0,1.18-.12,6.9,6.9,0,0,0,.93-.26c.27-.1.5-.18.68-.26a1.42,1.42,0,0,1,.5-.11.76.76,0,0,1,.38.11.81.81,0,0,1,.28.46,7.61,7.61,0,0,1,.17.93A10.14,10.14,0,0,1,872,435Z"/><path class="cls-2" d="M896.59,411.54c0,.78,0,1.42-.07,1.92a6.17,6.17,0,0,1-.19,1.17,1.1,1.1,0,0,1-.35.59.84.84,0,0,1-.53.16,1.69,1.69,0,0,1-.59-.11l-.73-.24c-.27-.09-.57-.17-.9-.25a5,5,0,0,0-1.07-.11,3.71,3.71,0,0,0-1.37.27,6,6,0,0,0-1.42.87,10.34,10.34,0,0,0-1.53,1.56,26.74,26.74,0,0,0-1.71,2.41v18.11a.87.87,0,0,1-.19.57,1.51,1.51,0,0,1-.67.41,5.53,5.53,0,0,1-1.26.24,24.67,24.67,0,0,1-4,0,5.43,5.43,0,0,1-1.25-.24,1.45,1.45,0,0,1-.67-.41.88.88,0,0,1-.2-.57V408.84a1,1,0,0,1,.17-.57,1.11,1.11,0,0,1,.58-.41,4.44,4.44,0,0,1,1.09-.24,13.05,13.05,0,0,1,1.68-.09,13.69,13.69,0,0,1,1.73.09,3.79,3.79,0,0,1,1.06.24,1.14,1.14,0,0,1,.53.41,1,1,0,0,1,.17.57v3.61a22.34,22.34,0,0,1,2.15-2.68,11.62,11.62,0,0,1,1.92-1.68,6,6,0,0,1,1.82-.86,6.78,6.78,0,0,1,1.83-.25c.28,0,.58,0,.91,0a10,10,0,0,1,1,.16,9.42,9.42,0,0,1,.91.26,1.83,1.83,0,0,1,.57.31,1,1,0,0,1,.26.36,3.85,3.85,0,0,1,.15.54,8.68,8.68,0,0,1,.09,1C896.58,410.14,896.59,410.76,896.59,411.54Z"/><path class="cls-2" d="M930.2,423.07a22.3,22.3,0,0,1-1,6.78,14.26,14.26,0,0,1-3,5.27,13.19,13.19,0,0,1-5,3.42,18.81,18.81,0,0,1-7,1.21,19.1,19.1,0,0,1-6.74-1.08,12,12,0,0,1-4.75-3.12A13,13,0,0,1,900,430.5a23.8,23.8,0,0,1-.91-6.84,21.75,21.75,0,0,1,1-6.79,14.18,14.18,0,0,1,3-5.28,13.19,13.19,0,0,1,5-3.4,18.47,18.47,0,0,1,7-1.21,19.4,19.4,0,0,1,6.77,1.06,11.78,11.78,0,0,1,4.74,3.11,13,13,0,0,1,2.79,5.05A23.57,23.57,0,0,1,930.2,423.07Zm-8.44.33a21.1,21.1,0,0,0-.34-4,9.35,9.35,0,0,0-1.15-3.14,5.88,5.88,0,0,0-2.17-2.09,7,7,0,0,0-3.4-.75,7.32,7.32,0,0,0-3.2.67,5.77,5.77,0,0,0-2.24,1.95,9.22,9.22,0,0,0-1.32,3.1,17.64,17.64,0,0,0-.44,4.12,20.37,20.37,0,0,0,.36,4A9.89,9.89,0,0,0,909,430.4a5.54,5.54,0,0,0,2.17,2.07,7.09,7.09,0,0,0,3.39.73,7.21,7.21,0,0,0,3.22-.67,5.76,5.76,0,0,0,2.25-1.94,9,9,0,0,0,1.3-3.07A18.33,18.33,0,0,0,921.76,423.4Z"/><path class="cls-2" d="M954.2,397.76c0,.63,0,1.14-.06,1.52a3.11,3.11,0,0,1-.2.88.94.94,0,0,1-.29.42.59.59,0,0,1-.36.11,1.23,1.23,0,0,1-.5-.11,6,6,0,0,0-.69-.24,9.36,9.36,0,0,0-1-.25,7,7,0,0,0-1.3-.11,3.81,3.81,0,0,0-1.51.27,2.51,2.51,0,0,0-1.06.88,4.1,4.1,0,0,0-.62,1.57,12.08,12.08,0,0,0-.2,2.36v2.67h5.31a.93.93,0,0,1,.54.16,1.24,1.24,0,0,1,.41.54,3.64,3.64,0,0,1,.24,1,14,14,0,0,1,.08,1.59,7.33,7.33,0,0,1-.32,2.56,1,1,0,0,1-1,.76h-5.31v23.52a.87.87,0,0,1-.19.57,1.49,1.49,0,0,1-.65.41,5.41,5.41,0,0,1-1.27.24,19,19,0,0,1-2,.08,18.34,18.34,0,0,1-2-.08,5.52,5.52,0,0,1-1.27-.24,1.32,1.32,0,0,1-.65-.41.92.92,0,0,1-.18-.57V414.37h-3.65c-.41,0-.72-.25-.93-.76a7.38,7.38,0,0,1-.31-2.56,14,14,0,0,1,.08-1.59,4.56,4.56,0,0,1,.23-1,1.15,1.15,0,0,1,.39-.54,1,1,0,0,1,.57-.16h3.62v-2.44a20.65,20.65,0,0,1,.58-5.2,9.44,9.44,0,0,1,1.84-3.71,7.75,7.75,0,0,1,3.2-2.23,12.61,12.61,0,0,1,4.57-.75,13.26,13.26,0,0,1,2.41.21,10.1,10.1,0,0,1,1.79.46,2.76,2.76,0,0,1,.88.45,1.6,1.6,0,0,1,.38.62,4.22,4.22,0,0,1,.21,1C954.18,396.61,954.2,397.13,954.2,397.76Z"/><path class="cls-2" d="M968.35,399c0,1.65-.33,2.79-1,3.42s-1.92.95-3.74.95-3.09-.31-3.73-.92a4.44,4.44,0,0,1-1-3.29,4.7,4.7,0,0,1,1-3.43c.66-.64,1.92-1,3.76-1s3.07.31,3.72.93A4.46,4.46,0,0,1,968.35,399Zm-.62,38.89a.87.87,0,0,1-.19.57,1.45,1.45,0,0,1-.67.41,5.43,5.43,0,0,1-1.25.24,24.79,24.79,0,0,1-4,0,5.43,5.43,0,0,1-1.25-.24,1.51,1.51,0,0,1-.67-.41.87.87,0,0,1-.19-.57v-29a.89.89,0,0,1,.19-.57,1.61,1.61,0,0,1,.67-.42,5.72,5.72,0,0,1,1.25-.28,19.85,19.85,0,0,1,4,0,5.72,5.72,0,0,1,1.25.28,1.55,1.55,0,0,1,.67.42.89.89,0,0,1,.19.57Z"/><path class="cls-2" d="M993.11,435a10.19,10.19,0,0,1-.18,2.2,2.49,2.49,0,0,1-.47,1.08,2.72,2.72,0,0,1-.87.55,7.46,7.46,0,0,1-1.33.42,13,13,0,0,1-1.66.28,15.56,15.56,0,0,1-1.81.1,13.12,13.12,0,0,1-4.24-.62,7,7,0,0,1-3-1.91,7.87,7.87,0,0,1-1.73-3.24,17,17,0,0,1-.55-4.62V414.37h-3.48c-.42,0-.73-.25-1-.76a7.1,7.1,0,0,1-.32-2.56,12,12,0,0,1,.08-1.59,3.64,3.64,0,0,1,.24-1,1.24,1.24,0,0,1,.41-.54,1,1,0,0,1,.57-.16h3.45v-6.48a1,1,0,0,1,.18-.59,1.4,1.4,0,0,1,.65-.44,5.5,5.5,0,0,1,1.27-.26c.53,0,1.19-.08,2-.08s1.47,0,2,.08a5.19,5.19,0,0,1,1.25.26,1.51,1.51,0,0,1,.65.44,1,1,0,0,1,.2.59v6.48h6.31a1,1,0,0,1,.57.16,1.17,1.17,0,0,1,.41.54,4,4,0,0,1,.25,1,14,14,0,0,1,.08,1.59,7,7,0,0,1-.33,2.56,1,1,0,0,1-.94.76h-6.35V428a6.79,6.79,0,0,0,.74,3.57,2.92,2.92,0,0,0,2.68,1.19,5.26,5.26,0,0,0,1.17-.12,6.51,6.51,0,0,0,.93-.26c.27-.1.5-.18.68-.26a1.42,1.42,0,0,1,.51-.11.72.72,0,0,1,.37.11.81.81,0,0,1,.28.46q.09.34.18.93A12,12,0,0,1,993.11,435Z"/><path class="cls-3" d="M229.05,199.64a60.12,60.12,0,0,1-3.74,21.71A56.23,56.23,0,0,1,215,238.55a64.45,64.45,0,0,1-15.76,12.85,97.13,97.13,0,0,1-20.2,8.86,137.38,137.38,0,0,1-23.54,5.12A212.57,212.57,0,0,1,127.59,267H59.82a17.48,17.48,0,0,1-10.94-3.39q-4.43-3.39-4.43-11V56.68q0-7.65,4.43-11a17.54,17.54,0,0,1,10.94-3.38h64q23.44,0,39.7,3.47t27.38,10.51a48.59,48.59,0,0,1,17,17.81q5.91,10.77,5.91,25.36a48.88,48.88,0,0,1-2.36,15.37,43.93,43.93,0,0,1-6.9,13.12,48.27,48.27,0,0,1-11.13,10.42,59.06,59.06,0,0,1-15.07,7.29,74,74,0,0,1,20,6.08,56.1,56.1,0,0,1,16,11.21A51,51,0,0,1,225.11,179,52,52,0,0,1,229.05,199.64Zm-67-94.67a29.88,29.88,0,0,0-2.37-12.16,22.21,22.21,0,0,0-7.09-9,34.25,34.25,0,0,0-11.92-5.47q-7.19-1.9-19.21-1.91H95.28v58.36h29q11.24,0,17.93-2.34a31.57,31.57,0,0,0,11.13-6.43,25.7,25.7,0,0,0,6.6-9.55A31,31,0,0,0,162.07,105Zm13.2,96.23a32,32,0,0,0-3-14,27.29,27.29,0,0,0-8.66-10.34,42.4,42.4,0,0,0-14.58-6.43q-8.88-2.25-23.06-2.25H95.28v63.92h37.43a70.64,70.64,0,0,0,18.23-2,39.18,39.18,0,0,0,12.8-5.9,27.76,27.76,0,0,0,8.47-9.73A28.13,28.13,0,0,0,175.27,201.2Z"/><path class="cls-4" d="M431.62,233c0,2.9-.09,5.36-.29,7.38a31.27,31.27,0,0,1-.89,5.21,13.8,13.8,0,0,1-1.57,3.74,18.78,18.78,0,0,1-3.16,3.56q-2.16,2-8.37,5.12a105.81,105.81,0,0,1-15.17,6,146,146,0,0,1-20.49,4.77,151.86,151.86,0,0,1-24.92,1.91q-26.2,0-47.29-7.12a94.91,94.91,0,0,1-35.85-21.28Q258.83,228.12,251,206.93t-7.88-49.33q0-28.66,8.67-50.9T276,69.36a102.44,102.44,0,0,1,37.33-22.93q21.78-7.82,48-7.82a130.93,130.93,0,0,1,20.49,1.56A139.78,139.78,0,0,1,400,44.26a99,99,0,0,1,15.07,5.81,46.1,46.1,0,0,1,9.36,5.65,20.12,20.12,0,0,1,3.65,3.91,13.49,13.49,0,0,1,1.57,4,39.33,39.33,0,0,1,.89,5.74q.3,3.3.3,8.16a84.78,84.78,0,0,1-.4,8.86,20.42,20.42,0,0,1-1.38,5.91,8.17,8.17,0,0,1-2.36,3.3,5.12,5.12,0,0,1-3.15,1q-3,0-7.49-3a126.32,126.32,0,0,0-11.72-6.78A103.58,103.58,0,0,0,387.2,80a82.06,82.06,0,0,0-23.74-3,64.16,64.16,0,0,0-27.09,5.47,56.58,56.58,0,0,0-20.3,15.63,69.58,69.58,0,0,0-12.7,24.59A112.69,112.69,0,0,0,299,155.17q0,19.8,4.63,34.3t13.2,23.89a53.09,53.09,0,0,0,20.69,14A76.34,76.34,0,0,0,364.84,232a87.46,87.46,0,0,0,23.83-2.87,107.43,107.43,0,0,0,17.24-6.34q7.2-3.47,11.82-6.25t7.2-2.78a6.23,6.23,0,0,1,3.15.69,5.25,5.25,0,0,1,2,2.78,24.51,24.51,0,0,1,1.18,5.82Q431.62,226.74,431.62,233Z"/><path class="cls-5" d="M642.66,261.13a6.13,6.13,0,0,1-.78,3.21c-.53.87-1.78,1.6-3.75,2.17a41.51,41.51,0,0,1-8.66,1.22c-3.82.23-9,.35-15.57.35q-8.28,0-13.2-.35a33,33,0,0,1-7.78-1.3,8.56,8.56,0,0,1-4-2.43,13,13,0,0,1-2-3.57l-22.86-50.2q-4.12-8.5-8.07-15.11a48.69,48.69,0,0,0-8.77-11,32.65,32.65,0,0,0-11.13-6.69,43.31,43.31,0,0,0-14.58-2.26H505.34v85.64a4.48,4.48,0,0,1-1.28,3.13,9.18,9.18,0,0,1-4.23,2.26,46.44,46.44,0,0,1-7.88,1.39q-4.93.51-12.61.52c-5,0-9.16-.18-12.51-.52a46.58,46.58,0,0,1-8-1.39,8.51,8.51,0,0,1-4.14-2.26,4.7,4.7,0,0,1-1.18-3.13V56.68q0-7.65,4.43-11a17.53,17.53,0,0,1,10.93-3.38h66q10,0,16.55.35t11.82.86A119.62,119.62,0,0,1,591,50.07a67.65,67.65,0,0,1,20.88,12.25,50.83,50.83,0,0,1,13.1,17.89,58.57,58.57,0,0,1,4.54,23.71,61.93,61.93,0,0,1-3.26,20.59,50.79,50.79,0,0,1-9.55,16.59,60.68,60.68,0,0,1-15.57,12.68A89.3,89.3,0,0,1,580,162.46a61.42,61.42,0,0,1,10.74,5.91,54.09,54.09,0,0,1,9.46,8.42,82,82,0,0,1,8.37,11.3,135.91,135.91,0,0,1,7.68,14.33l21.48,44.29q3,6.6,3.94,9.64A16.88,16.88,0,0,1,642.66,261.13ZM575.88,108.61q0-11.11-5.72-18.76T551.45,79.08a83.62,83.62,0,0,0-9-1.39q-5-.51-13.89-.52H505.34v63.75h26.4a71.3,71.3,0,0,0,19.31-2.34,40.41,40.41,0,0,0,13.79-6.6,27.46,27.46,0,0,0,8.28-10.16A31,31,0,0,0,575.88,108.61Z"/><path class="cls-6" d="M130.16,405.21c0,1.74,0,3.21-.16,4.43a20.73,20.73,0,0,1-.47,3.12,8.3,8.3,0,0,1-.83,2.23,11,11,0,0,1-1.66,2.14,21.28,21.28,0,0,1-4.43,3.07,52,52,0,0,1-8,3.59,70.12,70.12,0,0,1-10.82,2.86,71.59,71.59,0,0,1-13.17,1.15,69.44,69.44,0,0,1-25-4.27,49.33,49.33,0,0,1-18.94-12.75,56.76,56.76,0,0,1-12-21.18Q30.55,376.91,30.56,360q0-17.18,4.58-30.49a63.53,63.53,0,0,1,12.8-22.38,53.71,53.71,0,0,1,19.72-13.74A66.62,66.62,0,0,1,93,288.75a60.54,60.54,0,0,1,10.83.94,66.2,66.2,0,0,1,9.62,2.44,48.5,48.5,0,0,1,8,3.49,24.11,24.11,0,0,1,4.94,3.38,11.48,11.48,0,0,1,1.92,2.34,8.8,8.8,0,0,1,.84,2.4,27.14,27.14,0,0,1,.47,3.43q.15,2,.15,4.89,0,3.12-.21,5.31a14,14,0,0,1-.72,3.54,5,5,0,0,1-1.25,2,2.52,2.52,0,0,1-1.67.62,7.14,7.14,0,0,1-4-1.82,64.68,64.68,0,0,0-6.2-4.06,50.92,50.92,0,0,0-9-4.06,38.59,38.59,0,0,0-12.54-1.82,29.63,29.63,0,0,0-25,12.65,44,44,0,0,0-6.72,14.72,85.67,85.67,0,0,0,.16,40,39.85,39.85,0,0,0,7,14.31,28.2,28.2,0,0,0,10.93,8.38,36.07,36.07,0,0,0,14.42,2.76,41.24,41.24,0,0,0,12.59-1.72,52.66,52.66,0,0,0,9.11-3.8q3.8-2.08,6.24-3.75a7.73,7.73,0,0,1,3.8-1.66,3,3,0,0,1,1.66.41,3.16,3.16,0,0,1,1.05,1.67,17,17,0,0,1,.62,3.49Q130.16,401.47,130.16,405.21Z"/><path class="cls-7" d="M235.75,374.72a70.92,70.92,0,0,1-3.12,21.64,45.57,45.57,0,0,1-9.47,16.86,42,42,0,0,1-15.93,10.93A59.64,59.64,0,0,1,184.86,428a61.33,61.33,0,0,1-21.55-3.43,38.76,38.76,0,0,1-15.19-10,41,41,0,0,1-9-16.13,74.88,74.88,0,0,1-2.92-21.86,70.26,70.26,0,0,1,3.18-21.7A45.6,45.6,0,0,1,149,338a42.52,42.52,0,0,1,15.87-10.88,59.48,59.48,0,0,1,22.33-3.85,62.31,62.31,0,0,1,21.64,3.39,37.71,37.71,0,0,1,15.15,9.94,41.44,41.44,0,0,1,8.9,16.13A75.56,75.56,0,0,1,235.75,374.72Zm-27,1a68.07,68.07,0,0,0-1.09-12.65,29.82,29.82,0,0,0-3.69-10,18.5,18.5,0,0,0-6.92-6.66,22.2,22.2,0,0,0-10.88-2.4,23,23,0,0,0-10.2,2.14,18.28,18.28,0,0,0-7.18,6.24,30,30,0,0,0-4.22,9.89,56.3,56.3,0,0,0-1.4,13.17,65.41,65.41,0,0,0,1.14,12.64,31.4,31.4,0,0,0,3.7,10,17.59,17.59,0,0,0,6.92,6.61,22.7,22.7,0,0,0,10.82,2.34A23.31,23.31,0,0,0,196.1,405a18.48,18.48,0,0,0,7.18-6.19,28.64,28.64,0,0,0,4.16-9.84A58.09,58.09,0,0,0,208.79,375.76Z"/><path class="cls-8" d="M397.75,422.07a2.85,2.85,0,0,1-.62,1.82,4.54,4.54,0,0,1-2.08,1.3,17.33,17.33,0,0,1-4,.78,61.36,61.36,0,0,1-6.35.26,62.83,62.83,0,0,1-6.45-.26,18.32,18.32,0,0,1-4-.78,4.19,4.19,0,0,1-2.08-1.3,3,3,0,0,1-.57-1.82V367a38.16,38.16,0,0,0-.89-8.54,20.11,20.11,0,0,0-2.7-6.61,12.85,12.85,0,0,0-4.58-4.26,13.54,13.54,0,0,0-6.61-1.51,15.65,15.65,0,0,0-9.47,3.64A63.74,63.74,0,0,0,337,360.35v61.72a2.85,2.85,0,0,1-.62,1.82,4.56,4.56,0,0,1-2.14,1.3,18.1,18.1,0,0,1-4,.78,60.3,60.3,0,0,1-6.25.26,61.49,61.49,0,0,1-6.35-.26,18.1,18.1,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V367a38.16,38.16,0,0,0-.89-8.54,20.74,20.74,0,0,0-2.65-6.61,12.3,12.3,0,0,0-4.58-4.26,13.61,13.61,0,0,0-6.56-1.51,15.75,15.75,0,0,0-9.57,3.64,61,61,0,0,0-10.31,10.61v61.72a2.79,2.79,0,0,1-.62,1.82,4.58,4.58,0,0,1-2.13,1.3,18.32,18.32,0,0,1-4,.78,77.67,77.67,0,0,1-12.7,0,18.1,18.1,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V329.24a3.2,3.2,0,0,1,.52-1.83,3.8,3.8,0,0,1,1.87-1.3,15.71,15.71,0,0,1,3.49-.78,46.35,46.35,0,0,1,5.36-.26,48.72,48.72,0,0,1,5.51.26,13.1,13.1,0,0,1,3.39.78,3.82,3.82,0,0,1,1.71,1.3,3.2,3.2,0,0,1,.52,1.83V340a61.41,61.41,0,0,1,15.36-12.49,32.91,32.91,0,0,1,16-4.17,40.63,40.63,0,0,1,10.3,1.2,29.37,29.37,0,0,1,8.17,3.43,25.88,25.88,0,0,1,6.2,5.36,31.49,31.49,0,0,1,4.37,7,78.42,78.42,0,0,1,8.17-7.7,48,48,0,0,1,7.91-5.26,36.34,36.34,0,0,1,7.8-3,32.35,32.35,0,0,1,8-1q9.25,0,15.61,3.13a27.37,27.37,0,0,1,10.25,8.48,34.12,34.12,0,0,1,5.57,12.54,67.1,67.1,0,0,1,1.66,15.19Z"/><path class="cls-9" d="M510.53,374.3a86.6,86.6,0,0,1-2.66,22.33,50.42,50.42,0,0,1-7.75,16.91,34.44,34.44,0,0,1-12.7,10.72A38.89,38.89,0,0,1,470,428a33.06,33.06,0,0,1-7.44-.78,28.41,28.41,0,0,1-6.56-2.39,39.66,39.66,0,0,1-6.29-4,72.42,72.42,0,0,1-6.46-5.62v43.72a3.09,3.09,0,0,1-.62,1.87,4.71,4.71,0,0,1-2.14,1.4,17.93,17.93,0,0,1-4,.89,65.19,65.19,0,0,1-12.7,0,18,18,0,0,1-4-.89,4.73,4.73,0,0,1-2.13-1.4,3,3,0,0,1-.63-1.87V329.24a3.27,3.27,0,0,1,.52-1.83,3.86,3.86,0,0,1,1.83-1.3,14.6,14.6,0,0,1,3.43-.78,46.35,46.35,0,0,1,5.36-.26,45.45,45.45,0,0,1,5.26.26,14.72,14.72,0,0,1,3.43.78,3.82,3.82,0,0,1,1.82,1.3,3.2,3.2,0,0,1,.52,1.83v10.92a94.92,94.92,0,0,1,8-7.33,48,48,0,0,1,8-5.31,36.4,36.4,0,0,1,8.37-3.18,39.46,39.46,0,0,1,9.22-1q10.19,0,17.38,4a32.82,32.82,0,0,1,11.7,11,49.23,49.23,0,0,1,6.61,16.24A89.8,89.8,0,0,1,510.53,374.3Zm-27.27,1.87a71.14,71.14,0,0,0-.89-11.39,33.43,33.43,0,0,0-3-9.73,18.42,18.42,0,0,0-5.62-6.82,14.32,14.32,0,0,0-8.69-2.55,17.53,17.53,0,0,0-5.15.78,20,20,0,0,0-5.2,2.55,37,37,0,0,0-5.47,4.58,65.74,65.74,0,0,0-5.93,7v30.6a61.12,61.12,0,0,0,10.51,10.77,16.93,16.93,0,0,0,10.41,3.8,14.43,14.43,0,0,0,8.69-2.6,20.06,20.06,0,0,0,5.88-6.82,33.92,33.92,0,0,0,3.38-9.52A52.47,52.47,0,0,0,483.26,376.17Z"/><path class="cls-10" d="M551.28,422.07a2.8,2.8,0,0,1-.63,1.82,4.52,4.52,0,0,1-2.13,1.3,18.2,18.2,0,0,1-4,.78,77.55,77.55,0,0,1-12.69,0,18.08,18.08,0,0,1-4-.78,4.56,4.56,0,0,1-2.14-1.3,2.85,2.85,0,0,1-.62-1.82V285.21a3.07,3.07,0,0,1,.62-1.87,4.64,4.64,0,0,1,2.14-1.41,18,18,0,0,1,4-.88,65.09,65.09,0,0,1,12.69,0,18.1,18.1,0,0,1,4,.88,4.6,4.6,0,0,1,2.13,1.41,3,3,0,0,1,.63,1.87Z"/><path class="cls-11" d="M624.81,425.61,613.57,458.5q-.93,2.6-5.1,3.75a64.23,64.23,0,0,1-18.84.78,9.47,9.47,0,0,1-3.74-1.2,2.77,2.77,0,0,1-1.36-2.08,6.8,6.8,0,0,1,.63-3l12.38-31.12a7.2,7.2,0,0,1-2.44-1.92,8.85,8.85,0,0,1-1.61-2.76l-32-85.35a17.6,17.6,0,0,1-1.35-5.56,3.81,3.81,0,0,1,1.25-3,8.21,8.21,0,0,1,4.22-1.51,58.3,58.3,0,0,1,7.85-.42c3,0,5.34.05,7.08.16a12.35,12.35,0,0,1,4.06.78,4.42,4.42,0,0,1,2.18,1.92,18.77,18.77,0,0,1,1.46,3.7l21.86,62.13h.31l20-63.38a7.1,7.1,0,0,1,1.62-3.59,6.74,6.74,0,0,1,3.28-1.3,51.25,51.25,0,0,1,8-.42,54.63,54.63,0,0,1,7.44.42,9,9,0,0,1,4.37,1.56,3.75,3.75,0,0,1,1.41,3.07,15.07,15.07,0,0,1-.84,4.53Z"/><path class="cls-12" d="M964.22,92.3V83.74h-8.39v4.19h-16L929,101.79h5v23.07l-12.6,10.92V114h8.4L916.38,97.17V84.58H902.11v6.71h-26L858.46,114h8.4v68.83l-13.43,11.71V52.68L787.59,82.06v37.27H758.13v33.5H718.64V164h8.88v38.12l-4.2,7.55,36.94,64.63L808.1,264.2,966.35,127.38l3.75-28.54ZM746.83,207.12H733.4V193.69h13.43Zm0-21.82H733.4V171.87h13.43Zm19.3,21.82H752.7V193.69h13.43Zm0-21.82H752.7V171.87h13.43Zm18.47,26.86h-9.9V130.74h9.9Zm31.23-3.55H795.51V188.29h20.32Zm0-33H795.51V155.28h20.32Zm0-31.62H795.51V123.66h20.32Zm0-33H795.51V90.64h20.32ZM845,208.61H824.71V188.29H845Zm0-33H824.71V155.28H845ZM845,144H824.71V123.66H845Zm0-33H824.71V90.64H845Zm56.24,69.3H888V132.42h13.25Z"/><path class="cls-13" d="M703.31,198.3a3.58,3.58,0,0,1,.14-.54c1.59-5.13,9.89-3.81,13.39-2.12,11.38,5.48,21.75,13.88,31.41,21.89a261.14,261.14,0,0,1,22.24,20.61c5.66,6,10.78,11.14,19.8,8.84,6.14-1.57,11.2-5.85,15.66-10.35,42.67-43.13,90.25-82.91,137.82-120.54,36.09-28.54,75.11-60.33,118.77-76.48,0,0,11.37-3.14,12.72,1.13s-8.38,2.17-39.2,30.44c-2,1.88-4.13,3.75-6.2,5.61l-7.51,6.69q-4.36,3.9-8.72,7.81-5,4.48-9.91,9-5.55,5.1-11,10.27-6.11,5.76-12.13,11.61-6.63,6.45-13.17,13-7.14,7.17-14.17,14.47-7.63,7.94-15.12,16-8.1,8.73-16,17.62-8.53,9.57-16.9,19.29-9,10.44-17.72,21-9.36,11.34-18.5,22.86-9.74,12.27-19.23,24.73-10.1,13.25-19.92,26.68-10.42,14.25-20.57,28.7c-2,2.85-4,5.7-6,8.56-3,4.3-5.11,8.62-10.5,10.18a11.21,11.21,0,0,1-11.14-2.66c-14.12-13.56-24.71-33.3-34.84-49.78-17.54-28.53-30.93-57.86-42.66-89.11A10.11,10.11,0,0,1,703.31,198.3Z"/><ellipse class="cls-14" cx="790.05" cy="352.33" rx="39.87" ry="7.55"/></svg>
                        </div>

                    </div>

                    <div class="card-body border-0">


                        <h3 class="my-3 _text-primary text-center">{{ __('Reset Password') }}</h3>


                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row mb-1">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                                <div class="form-group">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-1">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                                <div class="form-group">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                       class="col-form-label">{{ __('Confirm Password') }}</label>

                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn _btn-primary btn-block">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
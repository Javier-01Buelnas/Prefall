@props(['size'=> 35, 'color' => 'black'])

@php
    switch($color){
        case 'black':
            $col = '#000000';
            break;
        case 'white':
            $col = '#ffffff';
            break;
        case 'orange':
            $col = '#ED760E';
            break;
        default:
            $col = '#000000';
            break;
    }
@endphp

<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="{{$size}}" height="{{$size}}" viewBox="0 0 172 172"
    style=" fill:#000000;">
    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
        stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none"
        font-size="none" text-anchor="none" style="mix-blend-mode: normal">
        <path d="M0,172v-172h172v172z" fill="none"></path>
        <g transform="scale(1.7551,1.7551)" fill="{{$col}}">
            <path
                d="M36.2,72.8c-4.97056,0 -9,4.02944 -9,9c0,4.97056 4.02944,9 9,9c4.97056,0 9,-4.02944 9,-9c0,-4.97056 -4.02944,-9 -9,-9zM74.2,72.8c-4.97056,0 -9,4.02944 -9,9c0,4.97056 4.02944,9 9,9c4.97056,0 9,-4.02944 9,-9c0,-4.97056 -4.02944,-9 -9,-9zM26,13.3c-1.23388,-3.71616 -4.68475,-6.24412 -8.6,-6.3h-6.7c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2h6.7c2.17453,0.04798 4.08945,1.44428 4.8,3.5l12.6,38.3l-0.9,2.3c-1.09658,2.86719 -0.80107,6.08087 0.8,8.7c1.66419,2.54069 4.46416,4.10867 7.5,4.2h39c1.10457,0 2,-0.89543 2,-2c0,-1.10457 -0.89543,-2 -2,-2h-39c-1.68372,-0.05817 -3.22495,-0.96035 -4.1,-2.4c-0.94399,-1.4211 -1.13084,-3.21486 -0.5,-4.8l1.2,-3c0.18031,-0.47924 0.2151,-1.00106 0.1,-1.5l-0.6,-1.5l40.7,-4.2c2.96337,-0.2667 5.42204,-2.40292 6.1,-5.3l4.2,-17.7l-60.2,-0.9z">
            </path>
        </g>
    </g>
</svg>
    
<ul role="tablist" class="nav nav-tabs">
    <li role="presentation" class="{{ isActive('petitions/*') }}">
        <a href="{{ route('petitions.show', ['slug' => $petition->slug]) }}">
            <i class="fa fa-file-text-o"></i> Petition text
        </a>
    </li>
    <li class="{{ isActive('signatures/*')}}">
        <a href="{{ route('petition.signatures', ['slug' => $petition->slug] )}}">
            <i class="fa fa-pencil"></i> Signatures ({{ $signatureCount }})
        </a>
    </li>
    <li>
        <a href="">
            <i class="fa fa-envelope"></i> Contact creator
        </a>
    </li>
</ul>
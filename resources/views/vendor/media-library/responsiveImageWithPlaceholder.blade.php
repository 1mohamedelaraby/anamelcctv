<img {!! $attributeString !!} class="img-fluid img-thumbnail max-w-full mx-auto" loading="{{ $loadingAttributeValue }}" srcset="{{ $media->getSrcset($conversion) }}"
    onload="this.onload=null;this.sizes=Math.ceil(this.getBoundingClientRect().width/window.innerWidth*100)+'vw';" sizes="1px" src="{{ $media->getUrl($conversion) }}"
    width="{{ $width }}">
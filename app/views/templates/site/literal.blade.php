
    <script type="text/javascript">

        var rootElems;

        $(function(){
            fotoramaInit();
            rootElems = navInit();
            console.log(rootElems);
        });

        function navInit() {
            var rootElems = $('#instaSlider .insta-slide').clone();
            var elems = rootElems.filter('[data-taste="0"]').clone().empty();
            var parent = $('#instaNavSlider');
            parent.append(elems);
            jCarouselInit();

            return rootElems;
        };     
    </script>

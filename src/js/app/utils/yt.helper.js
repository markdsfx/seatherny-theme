class YTHelper {

    static getIdFromUrlString(url) {

        let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        let match = url.match(regExp);

        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return false;
        }

    }

    static createEmbedCode(id, width = 560, height = 350, other_params = 'allowfullscreen') {

        return '<iframe width="'+ width +'" height="'+ height +'" src="//www.youtube.com/embed/'+ id +'" frameborder="0" '+ other_params +'></iframe>';

    }

}

export { YTHelper };
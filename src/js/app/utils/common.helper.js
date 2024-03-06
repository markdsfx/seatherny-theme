class CommonHelper {

    static isFunction(_var){

        return (typeof _var === 'function');

    }

    static execFunction(func, ...params){

        if(this.isFunction(func)){
            return func(...params);
        }
        return false;

    }

    static stringIsEmpty(string){

        if(!string) return true;
        return (String(string).length && String(string).trim() != '') ? false : true;
        
    }

    static isValidEmail(email){

        if(!email) return true;
        let reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return reg.test(email);

    }

    static isInViewport(ins, offset) {

        var offset = (offset) ? offset : 0;
        var elementTop = ins.offset().top + 10 - offset;
        var elementBottom = elementTop + ins.outerHeight() - offset;
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
        return elementBottom > viewportTop && elementTop < viewportBottom;

    }

    static getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    static pad(num, size) {
        var s = num+"";
        while (s.length < size) s = "0" + s;
        return s;
    }

    static checkFileSize($file, limit = 3000000){

        let valid = true;

        if(!window.FileReader){ } 
        else {
            if($file){
                if(!$file[0]){ }
                else{
                    if(!$file[0].files){ } 
                    else {
                        if(!$file[0].files[0]){ }
                        else{
                            let size = $file[0].files[0].size;
                            if(size > limit){
                                valid = false;
                            }
                        } 
                    }
                }
            }
        }

        return valid;

    }

    static numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

}

export { CommonHelper };
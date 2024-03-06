class XHRequest {

    constructor(options) {

        this.status = 'pending';
        this.response = false;

        this.options = Object.assign(
            {},  
            {
                url : '',
                data : {},
                dataType : 'json',
                type : 'POST',
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                processData : true,
                cache: false,
                callbacks : {
                    beforeSend : (x) => {},
                    success : (response) => {},
                    complete : (x, s) => {},
                    error : (x, s, e) => {}
                }
            }, 
            options
        );

    }

    getStatus(){

        return this.status;

    }

    setStatus(status){

        this.status = status;
        return this;

    }

    setOptions(options){

        if(typeof(options) == 'object'){
            if(typeof(Object.assign) == 'function'){
                Object.assign(this.options, options);
            } else {
                $.extend(this.options, options);
            }
        }
        return this.options;

    }

    getOptions(){

        return this.options;

    }

    setResponse(response){

        this.response = response;
        return this;

    }

    getResponse(){

        return this.response;

    }

}

export { XHRequest };
import { CommonHelper } from '../utils/common.helper';
import { XHRequest } from './xhrequest';

class XHRHelper {

    constructor() {

        this.requests = []; // request pool
        this._request = {}; // current request

    }

    createRequest(opts){
        return new XHRequest(opts);
    }

    createAndAddRequest(opts){

        let newRequest = this.createRequest(opts);
        this.addRequest(newRequest);
        this.setCurrentRequest(newRequest);
        return this;

    }

    addRequest(request){

        if(request instanceof XHRequest){
            this.requests[request.id] = request;
        } 
        return request;

    }

    sendRequest(request){

        let req = (request instanceof XHRequest) ? request : this._request;
        let rqo = req.getOptions();
        
        $.ajax({
            url : rqo.url,
            data : rqo.data,
            dataType : rqo.dataType,
            type : rqo.type,
            cache: rqo.cache,
            processData: rqo.processData, 
            contentType: rqo.contentType,   
            beforeSend : (x) => {
                req.setStatus('sending');
                CommonHelper.execFunction(rqo.callbacks.beforeSend, x);
            },
            success : (response) => {
                req.setStatus('success').setResponse(response);
                CommonHelper.execFunction(rqo.callbacks.success, response);
            },
            complete : (x, s) => {
                CommonHelper.execFunction(rqo.callbacks.complete, x, s);
            },
            error : (x, s, e) => {
                req.setStatus('error').setResponse({x, s, e});
                CommonHelper.execFunction(rqo.callbacks.error, x, s, e);
            }
        });

    }

    setCurrentRequest(request){

        this._request = (request instanceof XHRequest) ? request : this.requests[request];
        return this;

    }

    getCurrentRequest(){

        return this._request;

    }

    getRequest(rq){

        let id = (rq instanceof XHRequest) ? rq.id : rq;

        if(id){
            if(id === true){
                return this.requests;
            }
            return (this.requests[id]) ? this.requests[id] : false;
        }
        return false;

    }

}

export { XHRHelper };
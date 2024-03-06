class VisibilityHelper {
    
    constructor() {
        
        this.hidden = 'hidden';
        this.visibilitychange = 'visibilitychange';
        this.state = 'visibilityState';

        if (typeof document.hidden !== "undefined") {
          this.hidden = "hidden";
          this.visibilitychange = "visibilitychange";
          this.state = "visibilityState";
        } else if (typeof document.mozHidden !== "undefined") {
          this.hidden = "mozHidden";
          this.visibilitychange = "mozvisibilitychange";
          this.state = "mozVisibilityState";
        } else if (typeof document.msHidden !== "undefined") {
          this.hidden = "msHidden";
          this.visibilitychange = "msvisibilitychange";
          this.state = "msVisibilityState";
        } else if (typeof document.webkitHidden !== "undefined") {
          this.hidden = "webkitHidden";
          this.visibilitychange = "webkitvisibilitychange";
          this.state = "webkitVisibilityState";
        }

    }

    isHidden() {

        return document[this.hidden] || false;

    }

    bindChangeEvent(focusCallback, blurCallback) {

        $(document).bind(this.visibilitychange, (e) => {
            if(this.isHidden()){
                blurCallback();
            } else {
                focusCallback();
            }
        });

    }

}

export { VisibilityHelper };
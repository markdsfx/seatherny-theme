import { CommonHelper } from '../utils/common.helper';

class CounterController {
    
    constructor($elem) {

        this.$elem = $elem;
        this.final = parseInt($elem.attr('data-value'));
        this.start = $elem.attr('data-start');
        this.start = (this.start) ? parseInt(this.start) : 0;
        this.interval_factor = $elem.attr('data-intf');
        this.interval_factor = (this.interval_factor) ? parseInt(this.interval_factor) : 1000;

        this.inv = false;

    }

    init() {

        this.$elem.text(CommonHelper.numberWithCommas(this.start));
        return this;

    }

    animateToFinal() {

        let i = this.start;

        this.inv = setInterval( () => {    
            if(i < this.final){
                this.$elem.text( CommonHelper.numberWithCommas(++i) );
            } else{
                clearInterval(this.inv);
            }
        }, (this.interval_factor / this.final) );

        return this.inv;

    }

    reset(){

        return this.init();

    }

}

export { CounterController };
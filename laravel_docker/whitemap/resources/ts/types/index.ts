// @types jquery.validationはバージョンが1.16で止まっていたので使わない。
// https://github.com/DefinitelyTyped/DefinitelyTyped/blob/master/types/jquery.validation/index.d.ts
// import JQueryValidation from 'jquery.validation';

interface JQuery {
    validate(options: any): JQuery;
}
interface JQueryStatic {
    validator: any;
}

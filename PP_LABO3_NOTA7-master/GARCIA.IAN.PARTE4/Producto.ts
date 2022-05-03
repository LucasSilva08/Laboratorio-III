namespace Entidades
{
    export class Producto{
        private nombre:string;
        private origen:string;

        constructor(nombre:string,origen:string) {
            this.nombre=nombre;
            this.origen=origen;
        }
        public toString():string {
            return this.ToJSON();
        }
        public ToJSON():string {
            return JSON.stringify(this);
        }
    }
}
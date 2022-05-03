namespace Entidades{
    export class ProductoEnvasado extends Producto{
        private id:number;
        private codigoBarra:string;
        private precio:number;
        private pathFoto:string;
        constructor(nombre:string,origen:string,id:number,cod:string,precio:number,path:string) {
            super(nombre,origen);
            this.id=id;
            this.codigoBarra=cod;
            this.precio=precio;
            this.pathFoto=path;
        }
        public ToJSON():string{
            return JSON.stringify(this);
        }
    }  
}
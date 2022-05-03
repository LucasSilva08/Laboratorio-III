//import {IParte2} from './Iparte2';
namespace PrimerParcial
{
    interface IParte2{
        EliminarProducto(json:any):void;
        ModificarProducto(json:any):void;
    }
    interface IParte3{
        VerificarProductoEnvasado():void;
        AgregarProductoFoto():void;
        BorrarProductoFoto(json:any):void;
        ModificarProductoFoto(json:any):void;
    }
    interface Iparte4{
        MostrarBorradosJSON():void;
        MostrarFotosModificados():void;
        FiltrarListado():void;
    }
    export class Manejadora implements IParte2,IParte3,Iparte4
    {
        public static AgregarProductoJSON():void{
        let xhr = new XMLHttpRequest();
        let nombre:string = (<HTMLInputElement> document.getElementById("nombre")).value;
        let origen:string = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
        xhr.open("POST","./BACKEND/AltaProductoJSON.php");
        var formD = new FormData();
        formD.append("nombre",nombre);
        formD.append("origen",origen);
        xhr.onreadystatechange = ():void => 
        {
            if (xhr.readyState === 4)
            {
                if (xhr.status === 200)
                {
                    console.log(xhr.responseText);
                    alert(xhr.responseText);
                }
            }
        }
        xhr.send(formD);
    }
        public static MostrarProductosJSON(){
            let xhr = new XMLHttpRequest();
            xhr.open("GET","./BACKEND/ListadoProductosJSON.php");
            xhr.send();
            xhr.onreadystatechange = ():void => {

                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        let productos = JSON.parse(xhr.responseText);
                        let tabla:string = "<table><tr><td>Nombre</td><td>Origen</td></tr>";
                        productos.forEach((element:any) => {
                            tabla+="<tr><td>"+element.nombre+"</td><td>"+element.origen+"</td></tr>";
                        });
                        tabla+="</table>";
                        (<HTMLInputElement> document.getElementById("divTabla")).innerHTML=tabla;
                        console.log(xhr.responseText);
                    }
                }
            };
        }
        public static VerificarProductoJSON(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST","./BACKEND/VerificarProductoJSON.php");
            var formD = new FormData();
            let nombre:string = (<HTMLInputElement> document.getElementById("nombre")).value;
            let origen:string = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
            formD.append("nombre",nombre);
            formD.append("origen",origen);
            xhr.onreadystatechange = ():void => {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.log(xhr.responseText);
                        alert(xhr.responseText);
                    }
                }
            };
            xhr.send(formD);
        }
        public static MostrarInfoCookie(){
            let xhr = new XMLHttpRequest();
            let nombre:string = (<HTMLInputElement> document.getElementById("nombre")).value;
            let origen:string = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
            xhr.open("GET","./BACKEND/MostrarCookie.php?"+"nombre="+nombre+"&origen="+origen);
            xhr.onreadystatechange = ():void => {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.log(xhr.responseText);
                        (<HTMLInputElement> document.getElementById("divInfo")).innerHTML=xhr.responseText;

                    }
                }
            };
            xhr.send();
        }
        public static AgregarProductoSinFoto():void{
            let nombre:string = (<HTMLInputElement> document.getElementById("nombre")).value;
            let origen:string = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
            let precio: string = (<HTMLInputElement> document.getElementById("precio")).value;
            let codigo_barra: string = (<HTMLInputElement> document.getElementById("codigoBarra")).value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/AgregarProductoSinFoto.php");
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhr.onreadystatechange = ():void => 
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                        Manejadora.MostrarProductosEnvasados();
                    }
                }
            }
            xhr.send('producto_json=' + '{"nombre":"'+nombre+'","origen":"'+origen+'","id":"","codigo_barra":"'+codigo_barra+'","precio":"'+precio+'"}');
        }
        public static MostrarProductosEnvasados():void{
            let xhr = new XMLHttpRequest();
            xhr.open("GET","./BACKEND/ListadoProductosEnvasados.php?tabla=json");
            xhr.onreadystatechange = ():void => {

                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        let productos = JSON.parse(xhr.responseText);
                        let tabla:string = "<table><tr><th>Nombre</th><th>Origen</th><th>CodBarra</th><th>Id</th><th>Precio</th><th>Foto</th></tr>";
                        productos.forEach((element:any) => {
                            let auxJson= JSON.stringify(element);
                            tabla+="<tr>"
                            tabla +="<td>"+element.nombre+"</td>"
                            tabla +="<td>"+element.origen+"</td>"
                            tabla +="<td>"+element.codigo_barra+"</td>"
                            tabla +="<td>"+element.id+"</td>"
                            tabla +="<td>"+element.precio+"</td>"
                            tabla +="<td> <img src='./Backend/productos/imagenes/"+element.pathFoto+"';width='50' height='50'></td>"
                            //tabla +='<td> <input type="button" value="Modificar" class="btn btn-danger" onclick=PrimerParcial.Manejadora.ModificarSinFoto(auxJson)/>'
                            if(!(<HTMLInputElement> document.getElementById("hdnIdModificacion")).value)
                            {
                                tabla += `<td> <input type="button" value="Modificar" class="btn btn-info" onclick=PrimerParcial.Manejadora.CargarForm('${auxJson}')></td>`;
                                tabla += `<td> <input type="button" value="Eliminar" class="btn btn-outline-danger" onclick=PrimerParcial.Manejadora.EliminarProducto('${auxJson}')></td>`;
                            }else{
                                tabla += `<td> <input type="button" value="Modificar Env" class="btn btn-info" onclick=PrimerParcial.Manejadora.CargarForm('${auxJson}')></td>`;
                                tabla += `<td> <input type="button" value="Eliminar Env" class="btn btn-outline-danger" onclick=PrimerParcial.Manejadora.BorrarProductoFoto('${auxJson}')></td>`;
                            }
                            tabla +="</tr>";
                        });
                        tabla+="</table>";
                        console.log(xhr.responseText);
                        (<HTMLInputElement> document.getElementById("divTabla")).innerHTML=tabla;
                    }
                }
            }
            xhr.send();
        }
        static CargarForm(json:any)
        {
            let parseado=JSON.parse(json);
            (<HTMLInputElement> document.getElementById("nombre")).value=parseado.nombre;
            (<HTMLInputElement> document.getElementById("cboOrigen")).value=parseado.origen.toString();
            (<HTMLInputElement> document.getElementById("idProducto")).value=parseado.id;
            (<HTMLInputElement> document.getElementById("codigoBarra")).value=parseado.codigo_barra;
            (<HTMLInputElement> document.getElementById("precio")).value=parseado.precio;
        }
        static LevantarJSON()
        {
            let nombre:string = (<HTMLInputElement> document.getElementById("nombre")).value;
            let origen:string = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
            let id:string = (<HTMLInputElement> document.getElementById("idProducto")).value;
            let codigo_barra:string = (<HTMLInputElement> document.getElementById("codigoBarra")).value;
            let precio: string = (<HTMLInputElement> document.getElementById("precio")).value;
            return '{"nombre":"'+nombre+'","origen":"'+origen+'","id":"'+id+'","codigo_barra":"'+codigo_barra+'","precio":"'+precio+'"}';
        }
        EliminarProducto(json:any)
        {
            Manejadora.EliminarProducto(json);
        }
        static EliminarProducto(json: any) {
            let miJson=JSON.parse(json);
            var input = confirm("Queres borrar este producto?"+miJson.nombre+" "+miJson.origen);
            if(input)
            {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "./Backend/EliminarProductoEnvasado.php");
                xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
                xhr.onreadystatechange = ():void => 
                {
                    if (xhr.readyState === 4)
                    {
                        if (xhr.status === 200)
                        {
                            alert(xhr.responseText);
                            console.log(xhr.responseText);
                            Manejadora.MostrarProductosEnvasados();
                        }
                    }
                }
                xhr.send('producto_json='+json);
            }
        }
        static ModificarSinFoto(json:any)
        {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/ModificarProductoEnvadado.php");
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhr.onreadystatechange = ():void => 
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.log(xhr.responseText);
                        let jsonRespuesta=JSON.parse(xhr.responseText);
                        if(jsonRespuesta.exito)
                        {
                            Manejadora.MostrarProductosEnvasados();
                        }
                        else
                        {
                            alert(xhr.responseText);
                            console.log(xhr.responseText);
                        }
                    }
                }
            }
            xhr.send("producto_json="+json);
        }
        ModificarProducto(json:any)
        {
            Manejadora.ModificarProducto(json);
        }
        static ModificarProducto(json: any) {
            let miJson=JSON.parse(json);
            let tabla:string = "<table><tr><th>Nombre</th><th>Origen</th><th>CodBarra</th><th>Id</th><th>Precio</th><th>Foto</th></tr>";
            tabla+="<tr>"
            +"<td>"+miJson.nombre+"</td>"
            +"<td>"+miJson.origen+"</td>"
            +"<td>"+miJson.codigo_barra+"</td>"
            +"<td>"+miJson.id+"</td>"
            +"<td>"+miJson.precio+"</td>"
            +"<td> <img src='"+miJson.pathFoto+"';width='50' height='50'></td>"
            +"</tr>";
            tabla+="</table>";
            (<HTMLInputElement> document.getElementById("divTabla")).innerHTML=tabla;
        }
        VerificarProductoEnvasado()
        {
            Manejadora.VerificarProductoEnvasado();
        }
        static VerificarProductoEnvasado(): void {
            const xhr = new XMLHttpRequest();
            let nombre:string = (<HTMLInputElement> document.getElementById("nombre")).value;
            let origen:string = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
            xhr.open("POST", "./Backend/VerificarProductoEnvasado.php");
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhr.onreadystatechange = ():void => 
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        (<HTMLInputElement> document.getElementById("divInfo")).innerHTML=xhr.responseText;
                        console.log(xhr.responseText);
                    }
                }
            }
            xhr.send('obj_producto={"nombre":"'+nombre+'","origen":"'+origen+'"}');
        }
        AgregarProductoFoto()
        {
            Manejadora.AgregarProductoFoto();
        }
        static AgregarProductoFoto(): void {
            let nombre:string           = (<HTMLInputElement> document.getElementById("nombre")).value;
            let origen:string           = (<HTMLInputElement> document.getElementById("cboOrigen")).value;
            let txtPrecio: string       = (<HTMLInputElement> document.getElementById("precio")).value;
            let codigoBarras: string    = (<HTMLInputElement> document.getElementById("codigoBarra")).value;
            let foto : any              = (<HTMLInputElement> document.getElementById("foto"));

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/AgregarProductoEnvasado.php");
            let form = new FormData();
            form.append("nombre",nombre);
            form.append("origen",origen);
            form.append("precio",txtPrecio);
            form.append("codigo_barra",codigoBarras);
            form.append("pathFoto",foto.files[0]);
            xhr.onreadystatechange = ():void => 
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.log(xhr.responseText);
                        Manejadora.MostrarProductosEnvasados();
                    }
                }
            }
            xhr.send(form);
        }
        BorrarProductoFoto(json:any)
        {
            Manejadora.BorrarProductoFoto(json);
        }
        static BorrarProductoFoto(json:any): void {
            let miJson=JSON.parse(json);
            var input = confirm("Queres borrar este producto?"+miJson.nombre+" "+miJson.codigo_barra);
            if(input)
            {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "./Backend/BorrarProductoEnvasado.php");
                xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
                xhr.onreadystatechange = ():void => 
                {
                    if (xhr.readyState === 4)
                    {
                        if (xhr.status === 200)
                        {
                            alert(xhr.responseText);
                            console.log(xhr.responseText);
                            Manejadora.MostrarProductosEnvasados();
                        }
                    }
                }
                xhr.send('producto_json='+json);
            }
        }
        ModificarProductoFoto(json:any)
        {
            Manejadora.ModificarProductoFoto(json);
        }
        static ModificarProductoFoto(json:any): void {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "./Backend/ModificarProductoEnvadadoFoto.php");
            let foto : any = (<HTMLInputElement> document.getElementById("foto"));
            let form = new FormData();
            form.append("foto",foto.files[0]);
            form.append("producto_json",json);

            xhr.onreadystatechange = ():void => 
            {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        alert(xhr.responseText);
                        console.log(xhr.responseText);
                        Manejadora.MostrarProductosEnvasados();
                    }
                }
            }
            xhr.send(form);
        }
        MostrarBorradosJSON()
        {
            Manejadora.MostrarBorradosJSON();
        }
        static MostrarBorradosJSON(): void {
            let xhr = new XMLHttpRequest();
            xhr.open("GET","./BACKEND/MostrarBorradosJSON.php");
            xhr.onreadystatechange = ():void => {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.log(xhr.responseText);
                        (<HTMLInputElement> document.getElementById("divInfo")).innerHTML=xhr.responseText;
                    }
                }
            };
            xhr.send();
        }
        MostrarFotosModificados()
        {
            Manejadora.MostrarFotosModificados();
        }
        static MostrarFotosModificados(): void {
            let xhr = new XMLHttpRequest();
            xhr.open("GET","./BACKEND/MostrarFotosDeModificados.php");
            xhr.onreadystatechange = ():void => {
                if (xhr.readyState === 4)
                {
                    if (xhr.status === 200)
                    {
                        console.log(xhr.responseText);
                        (<HTMLInputElement> document.getElementById("divInfo")).innerHTML=xhr.responseText;
                    }
                }
            };
            xhr.send();
        }
        FiltrarListado()
        {
            Manejadora.FiltrarListado();
        }
        static FiltrarListado(): void {
            throw new Error("Method not implemented.");
        }
    }
}

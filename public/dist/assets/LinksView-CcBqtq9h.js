var q=Object.defineProperty;var H=(e,t,n)=>t in e?q(e,t,{enumerable:!0,configurable:!0,writable:!0,value:n}):e[t]=n;var x=(e,t,n)=>H(e,typeof t!="symbol"?t+"":t,n);import{B as V,A as D,d as U,c as d,o as a,n as M,l as u,k as T,m as v,p as F,a as o,t as b,x as L,_ as E,j as r,w,y as z,u as S,q as K,F as W,z as G,h as P}from"./index-kntWLV53.js";import{a as J}from"./index-BfVev8UP.js";import{s as Q}from"./index-D2ZqCMY1.js";import{s as X}from"./index-gu6ni-Ma.js";var Y=({dt:e})=>`
.p-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: ${e("tag.primary.background")};
    color: ${e("tag.primary.color")};
    font-size: ${e("tag.font.size")};
    font-weight: ${e("tag.font.weight")};
    padding: ${e("tag.padding")};
    border-radius: ${e("tag.border.radius")};
    gap: ${e("tag.gap")};
}

.p-tag-icon {
    font-size: ${e("tag.icon.size")};
    width: ${e("tag.icon.size")};
    height:${e("tag.icon.size")};
}

.p-tag-rounded {
    border-radius: ${e("tag.rounded.border.radius")};
}

.p-tag-success {
    background: ${e("tag.success.background")};
    color: ${e("tag.success.color")};
}

.p-tag-info {
    background: ${e("tag.info.background")};
    color: ${e("tag.info.color")};
}

.p-tag-warn {
    background: ${e("tag.warn.background")};
    color: ${e("tag.warn.color")};
}

.p-tag-danger {
    background: ${e("tag.danger.background")};
    color: ${e("tag.danger.color")};
}

.p-tag-secondary {
    background: ${e("tag.secondary.background")};
    color: ${e("tag.secondary.color")};
}

.p-tag-contrast {
    background: ${e("tag.contrast.background")};
    color: ${e("tag.contrast.color")};
}
`,Z={root:function(t){var n=t.props;return["p-tag p-component",{"p-tag-info":n.severity==="info","p-tag-success":n.severity==="success","p-tag-warn":n.severity==="warn","p-tag-danger":n.severity==="danger","p-tag-secondary":n.severity==="secondary","p-tag-contrast":n.severity==="contrast","p-tag-rounded":n.rounded}]},icon:"p-tag-icon",label:"p-tag-label"},ee=V.extend({name:"tag",style:Y,classes:Z}),te={name:"BaseTag",extends:D,props:{value:null,severity:null,rounded:Boolean,icon:String},style:ee,provide:function(){return{$pcTag:this,$parentInstance:this}}};function m(e){"@babel/helpers - typeof";return m=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(t){return typeof t}:function(t){return t&&typeof Symbol=="function"&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},m(e)}function ne(e,t,n){return(t=ie(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function ie(e){var t=oe(e,"string");return m(t)=="symbol"?t:t+""}function oe(e,t){if(m(e)!="object"||!e)return e;var n=e[Symbol.toPrimitive];if(n!==void 0){var c=n.call(e,t);if(m(c)!="object")return c;throw new TypeError("@@toPrimitive must return a primitive value.")}return(t==="string"?String:Number)(e)}var O={name:"Tag",extends:te,inheritAttrs:!1,computed:{dataP:function(){return U(ne({rounded:this.rounded},this.severity,this.severity))}}},re=["data-p"];function le(e,t,n,c,i,l){return a(),d("span",v({class:e.cx("root"),"data-p":l.dataP},e.ptmi("root")),[e.$slots.icon?(a(),M(F(e.$slots.icon),v({key:0,class:e.cx("icon")},e.ptm("icon")),null,16,["class"])):e.icon?(a(),d("span",v({key:1,class:[e.cx("icon"),e.icon]},e.ptm("icon")),null,16)):u("",!0),e.value!=null||e.$slots.default?T(e.$slots,"default",{key:2},function(){return[o("span",v({class:e.cx("label")},e.ptm("label")),b(e.value),17)]}):u("",!0)],16,re)}O.render=le;const $={async getUseLinks(){return(await L.post("links/user-links",{})).data},async saveLink(e){return(await L.post("links/save-link",{id:e.id,link:e.link})).data},async deleteLink(e){return(await L.post("links/delete-link",{link_id:e.id})).data}};class _{constructor(t={}){x(this,"id",0);x(this,"link","");this.id=t.id??0,this.link=t.link??""}clear(){this.link=""}}class j{async getUserLinks(){try{return await $.getUseLinks()}catch{return!1}}async saveLink(t){try{return await $.saveLink(t)}catch{return!1}}async deleteLink(t){try{return await $.deleteLink(t)}catch{return!1}}}class B{constructor(){this.linksRepository=new j}async getUserLinks(){try{const t=await this.linksRepository.getUserLinks();if(t.status==="success"){let n=[];for(let c of t.data.links)n.push(new _({id:c.id,link:c.link}));return n}return[]}catch{return!1}}async saveLink(t){try{return await this.linksRepository.saveLink(t)}catch{return!1}}async deleteLink(t){try{return await this.linksRepository.deleteLink(t)}catch{return!1}}}const se={name:"LinkEditor",setup(){const e=new j,t=new B;return{linkRepository:e,linkUseCase:t}},props:{modelValue:{type:Boolean,default:!1},link:{type:Object,required:!0}},data(){return{modalOpen:this.value,linkEditor:{id:0,link:""},loading:!1}},watch:{modelValue(e){e?this.openModal():this.closeModal()},modalOpen(e){e&&(this.linkEditor.id=this.link.id,this.linkEditor.link=this.link.link)}},methods:{openModal(){this.modalOpen=!0,this.clearLinkData()},closeModal(){this.modalOpen=!1,this.$emit("update:modelValue",!1)},async saveLink(){this.loading=!0,await this.linkRepository.saveLink(new _({id:this.linkEditor.id,link:this.linkEditor.link})),this.loading=!1,this.$emit("reload"),this.closeModal()},clearLinkData(){this.linkEditor={id:0,link:""}}}},ae={key:0},de={key:0,class:"w-full px-2"},ce={class:"flex justify-end gap-2 mt-4"};function ue(e,t,n,c,i,l){const k=X,p=S,g=z;return a(),d("div",null,[r(g,{visible:i.modalOpen,"onUpdate:visible":t[1]||(t[1]=y=>i.modalOpen=y),modal:"",header:"Линк",style:{width:"25rem"},onHide:l.closeModal},{default:w(()=>[i.modalOpen?(a(),d("div",ae,[i.linkEditor?(a(),d("div",de,[r(k,{modelValue:i.linkEditor.link,"onUpdate:modelValue":t[0]||(t[0]=y=>i.linkEditor.link=y),rows:"3",required:"",placeholder:"Link",fluid:""},null,8,["modelValue"])])):u("",!0)])):u("",!0),o("div",ce,[r(p,{type:"button",label:"Закрыть",size:"small",severity:"secondary",onClick:l.closeModal},null,8,["onClick"]),r(p,{type:"button",label:"Сохранить",size:"small",severity:"success",onClick:l.saveLink},null,8,["onClick"])])]),_:1},8,["visible","onHide"])])}const pe=E(se,[["render",ue],["__scopeId","data-v-555e9660"]]);var ge=({dt:e})=>`
.p-divider-horizontal {
    display: flex;
    width: 100%;
    position: relative;
    align-items: center;
    margin: ${e("divider.horizontal.margin")};
    padding: ${e("divider.horizontal.padding")};
}

.p-divider-horizontal:before {
    position: absolute;
    display: block;
    inset-block-start: 50%;
    inset-inline-start: 0;
    width: 100%;
    content: "";
    border-block-start: 1px solid ${e("divider.border.color")};
}

.p-divider-horizontal .p-divider-content {
    padding: ${e("divider.horizontal.content.padding")};
}

.p-divider-vertical {
    min-height: 100%;
    display: flex;
    position: relative;
    justify-content: center;
    margin: ${e("divider.vertical.margin")};
    padding: ${e("divider.vertical.padding")};
}

.p-divider-vertical:before {
    position: absolute;
    display: block;
    inset-block-start: 0;
    inset-inline-start: 50%;
    height: 100%;
    content: "";
    border-inline-start: 1px solid ${e("divider.border.color")};
}

.p-divider.p-divider-vertical .p-divider-content {
    padding: ${e("divider.vertical.content.padding")};
}

.p-divider-content {
    z-index: 1;
    background: ${e("divider.content.background")};
    color: ${e("divider.content.color")};
}

.p-divider-solid.p-divider-horizontal:before {
    border-block-start-style: solid;
}

.p-divider-solid.p-divider-vertical:before {
    border-inline-start-style: solid;
}

.p-divider-dashed.p-divider-horizontal:before {
    border-block-start-style: dashed;
}

.p-divider-dashed.p-divider-vertical:before {
    border-inline-start-style: dashed;
}

.p-divider-dotted.p-divider-horizontal:before {
    border-block-start-style: dotted;
}

.p-divider-dotted.p-divider-vertical:before {
    border-inline-start-style: dotted;
}

.p-divider-left:dir(rtl),
.p-divider-right:dir(rtl) {
    flex-direction: row-reverse;
}
`,ye={root:function(t){var n=t.props;return{justifyContent:n.layout==="horizontal"?n.align==="center"||n.align===null?"center":n.align==="left"?"flex-start":n.align==="right"?"flex-end":null:null,alignItems:n.layout==="vertical"?n.align==="center"||n.align===null?"center":n.align==="top"?"flex-start":n.align==="bottom"?"flex-end":null:null}}},ve={root:function(t){var n=t.props;return["p-divider p-component","p-divider-"+n.layout,"p-divider-"+n.type,{"p-divider-left":n.layout==="horizontal"&&(!n.align||n.align==="left")},{"p-divider-center":n.layout==="horizontal"&&n.align==="center"},{"p-divider-right":n.layout==="horizontal"&&n.align==="right"},{"p-divider-top":n.layout==="vertical"&&n.align==="top"},{"p-divider-center":n.layout==="vertical"&&(!n.align||n.align==="center")},{"p-divider-bottom":n.layout==="vertical"&&n.align==="bottom"}]},content:"p-divider-content"},ke=V.extend({name:"divider",style:ge,classes:ve,inlineStyles:ye}),me={name:"BaseDivider",extends:D,props:{align:{type:String,default:null},layout:{type:String,default:"horizontal"},type:{type:String,default:"solid"}},style:ke,provide:function(){return{$pcDivider:this,$parentInstance:this}}};function f(e){"@babel/helpers - typeof";return f=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(t){return typeof t}:function(t){return t&&typeof Symbol=="function"&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},f(e)}function C(e,t,n){return(t=fe(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function fe(e){var t=he(e,"string");return f(t)=="symbol"?t:t+""}function he(e,t){if(f(e)!="object"||!e)return e;var n=e[Symbol.toPrimitive];if(n!==void 0){var c=n.call(e,t);if(f(c)!="object")return c;throw new TypeError("@@toPrimitive must return a primitive value.")}return(t==="string"?String:Number)(e)}var N={name:"Divider",extends:me,inheritAttrs:!1,computed:{dataP:function(){return U(C(C(C({},this.align,this.align),this.layout,this.layout),this.type,this.type))}}},be=["aria-orientation","data-p"],we=["data-p"];function _e(e,t,n,c,i,l){return a(),d("div",v({class:e.cx("root"),style:e.sx("root"),role:"separator","aria-orientation":e.layout,"data-p":l.dataP},e.ptmi("root")),[e.$slots.default?(a(),d("div",v({key:0,class:e.cx("content"),"data-p":l.dataP},e.ptm("content")),[T(e.$slots,"default")],16,we)):u("",!0)],16,be)}N.render=_e;const xe={name:"MaterialCategories",props:{modelValue:{type:Boolean,default:!1},categories:{type:Array,default:()=>[]},materialName:{type:String,default:null}},data(){return{modalOpen:this.value,currentCategories:[],loading:!1}},watch:{modelValue(e){e?this.openModal():this.closeModal()},modalOpen(e){e&&(this.currentCategories=this.categories)}},methods:{openModal(){this.modalOpen=!0,this.clearLinkData()},closeModal(){this.modalOpen=!1,this.$emit("update:modelValue",!1)},clearLinkData(){this.currentCategories=[]}}},Le={class:"mb-3"},$e={class:"flex justify-end gap-2 mt-4"};function Ce(e,t,n,c,i,l){const k=N,p=S,g=z;return a(),d("div",null,[r(g,{visible:i.modalOpen,"onUpdate:visible":t[0]||(t[0]=y=>i.modalOpen=y),modal:"",header:"Категории",style:{width:"40rem"},onHide:l.closeModal},{default:w(()=>[o("h3",Le,b(n.materialName),1),r(k),t[1]||(t[1]=K(" Тут будут категории и их привязка к конкретному материалу ")),o("div",$e,[r(p,{type:"button",label:"Закрыть",size:"small",severity:"secondary",onClick:l.closeModal},null,8,["onClick"])])]),_:1},8,["visible","onHide"])])}const Me=E(xe,[["render",Ce]]),Ee={name:"Links",components:{LinkEditor:pe,MaterialCategories:Me},setup(){return{linksUseCase:new B}},data(){return{links:[],loading:!1,errorType:null,newLink:null,linkEditorModal:{show:!1,link:{}},categoriesEditorModal:{show:!1,categories:[],materialName:null},deleteLinkModal:{show:!1,link:null}}},methods:{clearNewLink(){this.newLink=null,this.errorType=null},async saveLink(){if(this.newLink&&this.newLink.trim().length===0)return!1;this.errorType=null,this.loading=!0;const e=await this.linksUseCase.saveLink(new _({id:0,link:this.newLink}));if(this.loading=!1,e.status==="fail")return e.info==="wrong_url_format"?this.errorType="wrong_url_format":e.info==="link_already_exists"?this.errorType="link_already_exists":this.errorType="unknown_error",!1;this.newLink=null,this.loadLinks()},openLinkEditor(e=null){this.linkEditorModal.link=e||new _,this.linkEditorModal.show=!0},openCategoriesEditor(e){this.categoriesEditorModal.materialName=e.link,this.categoriesEditorModal.categories=e.link,console.log("openCategoriesEditor",e),this.categoriesEditorModal.show=!0},async loadLinks(){this.loading=!0,this.links=await this.linksUseCase.getUserLinks(),this.loading=!1},openDeleteLinkModal(e){this.deleteLinkModal.link=e,this.deleteLinkModal.show=!0},async deleteLink(){if(this.deleteLinkModal&&!this.deleteLinkModal.link)return!1;await this.linksUseCase.deleteLink(this.deleteLinkModal.link),this.deleteLinkModal.show=!1,this.loadLinks()}},mounted(){this.loadLinks()}},ze={class:"flex flex-1 overflow-hidden mt-4"},Se={class:"flex-1 ml-4 mr-4 overflow-y-auto"},Pe={class:"mb-4"},Ve={class:"flex flex-wrap -mx-2"},De={class:"w-full md:w-2/3 px-2"},Ue={class:"w-full md:w-1/3 px-2"},Te={key:0,class:"wrong-url-format mt-2 ml-1 mb-4"},Oe={key:1,class:"wrong-url-format mt-2 ml-1 mb-4"},je={key:2,class:"wrong-url-format mt-2 ml-1 mb-4"},Be={key:0,class:"mb-4"},Ne={class:"flex flex-wrap mb-2"},Ie={class:"absolute top-2 right-2 flex space-x-0"},Re={class:"absolute bottom-2 right-5 flex space-x-0"},Ae={class:"link-id text-gray-900 dark:text-gray-600 text-xs"},qe={class:"mb-2"},He={class:"flex text-gray-900 dark:text-gray-500 text-xs"},Fe=["onClick"],Ke=["onClick"],We=["onClick"],Ge=["href"],Je={class:"flex flex-wrap gap-2 mt-3"},Qe={key:1,class:"mb-4"},Xe={class:"flex justify-end gap-2"};function Ye(e,t,n,c,i,l){const k=Q,p=S,g=O,y=J,I=P("LinkEditor"),R=P("MaterialCategories"),A=z;return a(),d("div",null,[t[14]||(t[14]=o("h1",null,"Каталог ссылок",-1)),o("div",ze,[t[11]||(t[11]=o("aside",{class:"w-64 overflow-y-auto"}," тут пока пусто потому что нет ни одной категории ",-1)),o("div",Se,[o("div",Pe,[o("div",Ve,[o("div",De,[r(k,{modelValue:i.newLink,"onUpdate:modelValue":t[0]||(t[0]=s=>i.newLink=s),type:"text",required:"",placeholder:"link",fluid:""},null,8,["modelValue"])]),o("div",Ue,[r(p,{label:"Сохранить",size:"small",loading:i.loading,onClick:t[1]||(t[1]=s=>l.saveLink())},null,8,["loading"]),r(p,{label:"Очистить",class:"ml-2",size:"small",severity:"secondary",onClick:t[2]||(t[2]=s=>l.clearNewLink())})])]),i.errorType==="wrong_url_format"?(a(),d("div",Te," не правильный формат линка ")):u("",!0),i.errorType==="unknown_error"?(a(),d("div",Oe," не известная ошибка при сохранении, попробуйте позже ")):u("",!0),i.errorType==="link_already_exists"?(a(),d("div",je," Точно такой же линк уже существует в системе ")):u("",!0)]),i.loading?(a(),d("div",Be," Загрузка... ")):u("",!0),o("div",null,[(a(!0),d(W,null,G(i.links,s=>(a(),d("div",{key:s.id},[o("div",Ne,[r(y,{class:"w-full relative"},{content:w(()=>[o("div",Ie,[i.loading?u("",!0):(a(),M(p,{key:0,class:"!text-xs",onClick:h=>l.openLinkEditor(s),disabled:i.loading,icon:"pi pi-pencil",severity:"info",variant:"text",rounded:""},null,8,["onClick","disabled"])),i.loading?u("",!0):(a(),M(p,{key:1,class:"!text-xs",onClick:h=>l.openDeleteLinkModal(s),disabled:i.loading,icon:"pi pi-trash",severity:"danger",variant:"text",rounded:""},null,8,["onClick","disabled"]))]),o("div",Re,[o("span",Ae," # "+b(s.id),1)]),o("div",null,[o("div",qe,[o("div",He,[o("div",{onClick:h=>l.openCategoriesEditor(s),class:"bg-gray-900 dark:bg-zinc-950 pl-2 pr-2 py-0 rounded-2xl cursor-pointer"}," Development / Python / FlaskAPI ",8,Fe),t[9]||(t[9]=o("span",{class:"text-gray-900 dark:text-gray-200 text-xs mx-1"},"•",-1)),o("div",{onClick:h=>l.openCategoriesEditor(s),class:"bg-gray-900 dark:bg-zinc-950 pl-2 pr-2 py-0 rounded-2xl cursor-pointer"}," AI / Stable Diffusion ",8,Ke),t[10]||(t[10]=o("span",{class:"text-gray-900 dark:text-gray-200 text-xs mx-1"},"•",-1)),o("div",{onClick:h=>l.openCategoriesEditor(s),class:"bg-gray-900 dark:bg-zinc-950 pl-2 pr-2 py-0 rounded-2xl cursor-pointer"}," Design / Gimp ",8,We)])]),o("a",{class:"",href:s.link,target:"_blank"},b(s.link),9,Ge),o("div",Je,[r(g,{value:"Primary",class:"!text-[10px]"}),r(g,{severity:"secondary",value:"Secondary",class:"!text-[10px]"}),r(g,{severity:"success",value:"Success",class:"!text-[10px]"}),r(g,{severity:"info",value:"Info",class:"!text-[10px]"}),r(g,{severity:"warn",value:"Warn",class:"!text-[10px]"}),r(g,{severity:"danger",value:"Danger",class:"!text-[10px]"}),r(g,{severity:"contrast",value:"Contrast",class:"!text-[10px]"})])])]),_:2},1024)])]))),128))]),!i.loading&&i.links.length===0?(a(),d("div",Qe," Ссылок пока нет ")):u("",!0)]),t[12]||(t[12]=o("aside",{class:"w-64 overflow-y-auto"}," Нет ни одного тега ",-1))]),r(I,{modelValue:i.linkEditorModal.show,"onUpdate:modelValue":t[3]||(t[3]=s=>i.linkEditorModal.show=s),link:i.linkEditorModal.link,onReload:t[4]||(t[4]=s=>l.loadLinks())},null,8,["modelValue","link"]),r(R,{modelValue:i.categoriesEditorModal.show,"onUpdate:modelValue":t[5]||(t[5]=s=>i.categoriesEditorModal.show=s),link:i.categoriesEditorModal.categories,"material-name":i.categoriesEditorModal.materialName,onReload:t[6]||(t[6]=s=>l.loadLinks())},null,8,["modelValue","link","material-name"]),r(A,{visible:i.deleteLinkModal.show,"onUpdate:visible":t[8]||(t[8]=s=>i.deleteLinkModal.show=s),modal:"",header:"Удаление линка",style:{width:"25rem"}},{default:w(()=>[t[13]||(t[13]=o("span",{class:"text-surface-500 dark:text-surface-400 block mb-8"},"Уверены что хотите удалить линк?",-1)),o("div",Xe,[r(p,{type:"button",label:"Отмена",size:"small",severity:"secondary",onClick:t[7]||(t[7]=s=>i.deleteLinkModal.show=!1)}),r(p,{type:"button",label:"Удалить",size:"small",severity:"danger",onClick:l.deleteLink},null,8,["onClick"])])]),_:1},8,["visible"])])}const ot=E(Ee,[["render",Ye],["__scopeId","data-v-be6be0e4"]]);export{ot as default};

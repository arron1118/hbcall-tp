/**
 * date:2020/02/27
 * author:Mr.Chung
 * version:2.0
 * description:layuimini 菜单框架扩展
 */
layui.define(["element", "laytpl", "jquery"], function (exports) {
    let element = layui.element,
        $ = layui.$,
        laytpl = layui.laytpl,
        layer = layui.layer;

    let miniMenu = {

        /**
         * 菜单初始化
         * @param options.menuList   菜单数据信息
         * @param options.multiModule 是否开启多模块
         * @param options.menuChildOpen 是否展开子菜单
         */
        render: function (options) {
            options.menuList = options.menuList || [];
            options.multiModule = options.multiModule || false;
            options.menuChildOpen = options.menuChildOpen || false;
            if (options.multiModule) {
                miniMenu.renderMultiModule(options.menuList, options.menuChildOpen);
            } else {
                miniMenu.renderSingleModule(options.menuList, options.menuChildOpen);
            }
            miniMenu.listen();
        },

        /**
         * 单模块
         * @param menuList 菜单数据
         * @param menuChildOpen 是否默认展开
         */
        renderSingleModule: function (menuList, menuChildOpen) {
            menuList = menuList || [];
            let leftMenuHtml = '',
                childOpenClass = '';
            if (menuChildOpen) childOpenClass = ' layui-nav-itemed';
            leftMenuHtml = this.renderLeftMenu(menuList, {childOpenClass: childOpenClass});
            $('.layui-layout-body').addClass('layuimini-single-module'); //单模块标识
            $('.layuimini-header-menu').remove();
            $('.layuimini-menu-left').html(leftMenuHtml);

            element.init();
        },

        /**
         * 渲染一级菜单
         */
        compileMenu: function (menu, isSub) {
            let menuHtml = '<li {{#if( d.menu){ }}  data-menu="{{d.menu}}" {{#}}} class="layui-nav-item menu-li {{d.childOpenClass}} {{d.className}}"  {{#if( d.id){ }}  id="{{d.id}}" {{#}}}> <a {{#if( d.href){ }} layuimini-href="{{d.href}}" {{#}}} {{#if( d.target){ }}  target="{{d.target}}" {{#}}} href="javascript:;">{{#if( d.icon){ }}  <i class="{{d.icon}}"></i> {{#}}} <span class="layui-left-nav">{{d.title}}</span></a>  {{# if(d.children){}} {{d.children}} {{#}}} </li>';
            if (isSub) {
                menuHtml = '<dd class="menu-dd {{d.childOpenClass}} {{ d.className }}"> <a href="javascript:;"  {{#if( d.menu){ }}  data-menu="{{d.menu}}" {{#}}} {{#if( d.id){ }}  id="{{d.id}}" {{#}}} {{#if(( !d.child || !d.child.length ) && d.href){ }} layuimini-href="{{d.href}}" {{#}}} {{#if( d.target){ }}  target="{{d.target}}" {{#}}}> {{#if( d.icon){ }}  <i class="{{d.icon}}"></i> {{#}}} <span class="layui-left-nav"> {{d.title}}</span></a> {{# if(d.children){}} {{d.children}} {{#}}}</dd>'
            }
            return laytpl(menuHtml).render(menu);
        },
        compileMenuContainer: function (menu, isSub) {
            let wrapperHtml = '<ul class="layui-nav layui-nav-tree layui-left-nav-tree {{d.className}}" id="{{d.id}}">{{d.children}}</ul>';
            if (isSub) {
                wrapperHtml = '<dl class="layui-nav-child ">{{d.children}}</dl>';
            }
            if (!menu.children) {
                return "";
            }
            return laytpl(wrapperHtml).render(menu);
        },

        each: function (list, callback) {
            let _list = [];
            for (let i = 0, length = list.length; i < length; i++) {
                _list[i] = callback(i, list[i]);
            }
            return _list;
        },
        renderChildrenMenu: function (menuList, options) {
            let me = this;
            menuList = menuList || [];
            let html = this.each(menuList, function (idx, menu) {
                if (menu.child && menu.child.length) {
                    menu.children = me.renderChildrenMenu(menu.child, {childOpenClass: options.childOpenClass || ''});
                }
                menu.className = "";
                menu.childOpenClass = options.childOpenClass || ''
                return me.compileMenu(menu, true)
            }).join("");
            return me.compileMenuContainer({children: html}, true)
        },
        renderLeftMenu: function (leftMenus, options) {
            options = options || {};
            let me = this;
            let leftMenusHtml = me.each(leftMenus || [], function (idx, leftMenu) { // 左侧菜单遍历
                let children = me.renderChildrenMenu(leftMenu.child, {childOpenClass: options.childOpenClass});
                let leftMenuHtml = me.compileMenu({
                    href: leftMenu.href,
                    target: leftMenu.target,
                    childOpenClass: options.childOpenClass,
                    icon: leftMenu.icon,
                    title: leftMenu.title,
                    children: children,
                    className: '',
                });
                return leftMenuHtml;
            }).join("");

            leftMenusHtml = me.compileMenuContainer({
                id: options.parentMenuId,
                className: options.leftMenuCheckDefault,
                children: leftMenusHtml
            });
            return leftMenusHtml;
        },
        /**
         * 多模块
         * @param menuList 菜单数据
         * @param menuChildOpen 是否默认展开
         */
        renderMultiModule: function (menuList, menuChildOpen) {
            menuList = menuList || [];
            let me = this;
            let headerMobileMenuHtml = '',
                leftMenuHtml = '',
                leftMenuCheckDefault = 'layui-this',
                childOpenClass = '',
                headerMenuCheckDefault = 'layui-this';

            if (menuChildOpen) childOpenClass = ' layui-nav-itemed';
            let headerMenuHtml = this.each(menuList, function (index, val) { //顶部菜单渲染
                let menu = 'multi_module_' + index;
                let id = menu + "HeaderId";
                let topMenuItemHtml = "";
                topMenuItemHtml = me.compileMenu({
                    className: headerMenuCheckDefault,
                    menu: menu,
                    id: id,
                    title: val.title,
                    href: "",
                    target: "",
                    children: ""
                });
                leftMenuHtml += me.renderLeftMenu(val.child, {
                    parentMenuId: menu,
                    childOpenClass: childOpenClass,
                    leftMenuCheckDefault: leftMenuCheckDefault
                });
                headerMobileMenuHtml += me.compileMenu({
                    id: id,
                    menu: menu,
                    icon: val.icon,
                    title: val.title,
                }, true);
                headerMenuCheckDefault = "";
                leftMenuCheckDefault = "layui-hide";
                return topMenuItemHtml;
            }).join("");
            $('.layui-layout-body').addClass('layuimini-multi-module'); //多模块标识
            $('.layuimini-menu-header-pc').html(headerMenuHtml); //电脑
            $('.layuimini-menu-left').html(leftMenuHtml);
            $('.layuimini-menu-header-mobile').html(headerMobileMenuHtml); //手机
            element.init();
        },

        /**
         * 监听
         */
        listen: function () {
            const body = $('body')

            /**
             * 菜单模块切换
             */
            body.on('click', '[data-menu]', function () {
                let loading = layer.load(0, {shade: false, time: 2000});
                let menuId = $(this).attr('data-menu');
                // header
                $(this).addClass('layui-this').siblings().removeClass('layui-this');
                // left
                $("#" + menuId).removeClass('layui-hide').addClass('layui-this').siblings().addClass('layui-hide');
                layer.close(loading);
            });

            /**
             * 菜单缩放
             */
            body.on('click', '.layuimini-site-mobile, [data-side-fold]', function () {
                let loading = layer.load(0, {shade: false, time: 2000});
                const dataSideFold = $('.layuimini-tool [data-side-fold]')
                const isShow = dataSideFold.attr('data-side-fold');
                if (isShow === '1') { // 缩放
                    dataSideFold.attr({
                        'data-side-fold': 0,
                        class: 'fa fa-indent'
                    });
                    $('.layui-layout-body').removeClass('layuimini-all').addClass('layuimini-mini');
                } else { // 正常
                    dataSideFold.attr({
                        'data-side-fold': 1,
                        class: 'fa fa-outdent'
                    });
                    $('.layui-layout-body').removeClass('layuimini-mini').addClass('layuimini-all');
                    layer.close(window.openTips);
                }
                element.init();
                layer.close(loading);
            });

            /**
             * 手机端点开模块
             */
            body.on('click', '.layuimini-header-menu.layuimini-mobile-show dd', function () {
                let loading = layer.load(0, {shade: false, time: 2 * 1000});
                let check = $('.layuimini-tool [data-side-fold]').attr('data-side-fold');
                if (check === "1") {
                    $('.layuimini-site-mobile').trigger("click");
                    element.init();
                }
                layer.close(loading);
            });
        },

    };


    exports("miniMenu", miniMenu);
});

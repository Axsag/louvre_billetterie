@charset "UTF-8";

// Default Variables

@slick-font-path: "./fonts/";
@slick-font-family: "slick";
@slick-loader-path: "./";
@slick-arrow-color: white;
@slick-dot-color: black;
@slick-dot-color-active: @slick-dot-color;
@slick-prev-character: "←";
@slick-next-character: "→";
@slick-dot-character: "•";
@slick-dot-size: 6px;
@slick-opacity-default: 0.75;
@slick-opacity-on-hover: 1;
@slick-opacity-not-active: 0.25;

/* Slider */
.slick-loading .slick-list{
    background: #fff url('@{slick-loader-path}ajax-loader.gif') center center no-repeat;
}

/* Arrows */
.slick-prev,
.slick-next {
    position: absolute;
    display: block;
    height: 20px;
    width: 20px;
    line-height: 0px;
    font-size: 0px;
    cursor: pointer;
    background: transparent;
    color: transparent;
    top: 50%;
    -webkit-transform: translate(0, -50%);
    -ms-transform: translate(0, -50%);
    transform: translate(0, -50%);
    padding: 0;
    border: none;
    outline: none;
    &:hover, &:focus {
        outline: none;
        background: transparent;
        color: transparent;
        &:before {
            opacity: @slick-opacity-on-hover;
        }
    }
    &.slick-disabled:before {
        opacity: @slick-opacity-not-active;
    }
}

.slick-prev:before, .slick-next:before {
    font-family: @slick-font-family;
    font-size: 20px;
    line-height: 1;
    color: @slick-arrow-color;
    opacity: @slick-opacity-default;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    
    & when ( @slick-font-family = 'slick' ) {
        /* Icons */
        @font-face {
            font-family: 'slick';
            font-weight: normal;
            font-style: normal;
            src: url('@{slick-font-path}slick.eot');
            src: url('@{slick-font-path}slick.eot?#iefix') format('embedded-opentype'), url('@{slick-font-path}slick.woff') format('woff'), url('@{slick-font-path}slick.ttf') format('truetype'), url('@{slick-font-path}slick.svg#slick') format('svg');
        }
    }
}

.slick-prev {
    left: -25px;
    [dir="rtl"] & {
        left: auto;
        right: -25px;
    }
    &:before {
        content: @slick-prev-character;
        [dir="rtl"] & {
            content: @slick-next-character;
        }
    }
}

.slick-next {
    right: -25px;
    [dir="rtl"] & {
        left: -25px;
        right: auto;
    }
    &:before {
        content: @slick-next-character;
        [dir="rtl"] & {
            content: @slick-prev-character;
        }
    }
}

/* Dots */

.slick-dotted .slick-slider {
    margin-bottom: 30px;
}

.slick-dots {
    position: absolute;
    bottom: -25px;
    list-style: none;
    display: block;
    text-align: center;
    padding: 0;
    margin: 0;
    width: 100%;
    li {
        position: relative;
        display: inline-block;
        height: 20px;
        width: 20px;
        margin: 0 5px;
        padding: 0;
        cursor: pointer;
        button {
            border: 0;
            background: transparent;
            display: block;
            height: 20px;
            width: 20px;
            outline: none;
            line-height: 0px;
            font-size: 0px;
            color: transparent;
            padding: 5px;
            cursor: pointer;
            &:hover, &:focus {
                outline: none;
                &:before {
                    opacity: @slick-opacity-on-hover;
                }
            }
            &:before {
                position: absolute;
                top: 0;
                left: 0;
                content: @slick-dot-character;
                width: 20px;
                height: 20px;
                font-family: @slick-font-family;
                font-size: @slick-dot-size;
                line-height: 20px;
                text-align: center;
                color: @slick-dot-color;
                opacity: @slick-opacity-not-active;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
        }
        &.slick-active button:before {
            color: @slick-dot-color-active;
            opacity: @slick-opacity-default;
        }
    }
}

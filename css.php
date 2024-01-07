<style>
    .mySlides {
        transform: scale(0);
        position: absolute;
        transition: all 0.3s;
        width: 100%;
    }

    img {
        vertical-align: middle;
        height: 500px;
        width: 100%;
        border-radius: 10px;
    }

    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
        height: 500px;
        margin-top: 100px;
        border-radius: 10px;
    }

    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        background: black;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        font-size: 40px;
        transition: all 0.3s;
    }

    .prev:hover,
    .next:hover {
        background: white;
        color: black;
    }

    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .dot {
        cursor: pointer;
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    button[type="submit"] {
        background: green;
        color: white;
        padding: 10px;
        width: 200px;
        border-radius: 3px;
        cursor: pointer;
        border: none;
        outline: none;
    }

    .input_handler_div .s_img_btn {
        background: black;
        color: white;
        padding: 10px;
        border-radius: 2px;
        width: 200px;
        cursor: pointer;
    }

    .input_handler_div input {
        position: absolute;
        margin-left: -190px;
        margin-top: 10px;
        opacity: 0;
        z-index: 9999;
        cursor: pointer;
    }

    .update_img_a {
        background: black;
        color: white;
        padding: 10px;
        width: 110px;
        border-radius: 5px;
        text-decoration: none;
        position: absolute;
        margin: 10px 0px 0px -150px;
    }

    .alert_h1 {
        background: black;
        color: white;
        padding: 20px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }
</style>
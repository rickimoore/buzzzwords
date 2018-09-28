<template>
    <div class="buzz--info modal">
        <div class="info--header">
            <img src="/image/logo/buzzword.png" alt="buzz">
        </div>
        <div class="info--body">
            <template v-if="type === '/about'">
                <h1>We believe, <br> marketing yourself for job opportunities <br> can be a pleasant experience.</h1>
                <p>So we design tools to help guide you. We are working hard with headhunters and recruiters around the world to understand what it takes to make the perfect candidate. Our goal is to take those tips and to guide users to their most marketable potential.</p>
            </template>
            <template v-if="type === '/contact'">
                <h1>We want to get in touch!</h1>
                <p>Please reach out to our social media or send us an email anytime.</p>
                <ul class="social">
                    <li><a href="https://www.facebook.com/mavrik.dev"><img src="/image/icons/001-facebook.svg" alt=""></a></li>
                    <li><a href="https://www.instagram.com/buzzz_word/"><img src="/image/icons/002-instagram.svg" alt=""></a></li>
                    <li><a href="/"><img src="/image/icons/003-email.svg" alt=""></a></li>
                </ul>
            </template>
        </div>
    </div>
</template>
<script>
    export default {
      props: ['type']
    }
</script>
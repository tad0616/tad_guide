<?php
use XoopsModules\Tadtools\Utility;

function tad_gphotos_content($csn = '')
{
    global $xoopsDB, $xoopsUser;

    $uid = $xoopsUser->uid();
    if (empty($csn)) {
        $sql = 'SELECT MAX(`sort`) FROM `' . $xoopsDB->prefix('tad_gphotos_cate') . '`';
        $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        list($max_sort) = $xoopsDB->fetchRow($result);

        $max_sort++;

        $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_gphotos_cate') . '`
        (`of_csn`, `sort`, `title`, `description`)
        VALUES
        (0, ?, ?, ?)';
        Utility::query($sql, 'iss', [$max_sort, '其他', '其他圖庫']) or Utility::web_error($sql, __FILE__, __LINE__);

        $csn = $xoopsDB->getInsertId();

    }

    $sql = "INSERT INTO `" . $xoopsDB->prefix('tad_gphotos') . "`
    (`csn`, `album_id`, `album_name`, `album_url`, `album_sort`, `album_counter`, `uid`, `create_date`)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $result = Utility::query($sql, 'isssiii', [$csn, 'AF1QipOA6jc2CkHKsNLAncOIxcuD8i-oX_-SssVV1VVk1NRZed6kbE7aPo9x4KXqRVoRjQ', '素材', 'https://photos.google.com/share/AF1QipOA6jc2CkHKsNLAncOIxcuD8i-oX_-SssVV1VVk1NRZed6kbE7aPo9x4KXqRVoRjQ?key=U0YtVHFmYU9tbU1kNlltMFJNV281TXVEZklPa3Bn', 0, 1, $uid]) or Utility::web_error($sql, __FILE__, __LINE__);

    $album_sn = $xoopsDB->getInsertId();

    $sql = "INSERT INTO `" . $xoopsDB->prefix('tad_gphotos_images') . "` (`album_sn`, `image_id`, `image_width`, `image_height`, `image_url`, `image_description`) VALUES
    ($album_sn,	'AF1QipPFwnjb5vwcQdl7rB0eupoVwh60R1XqdlMrWI2t',	1280,	800,	'https://lh3.googleusercontent.com/IvQ1LirMrGfRGGm8Tmyky1k-AgW1vqc4ydZqJuWOzpQUKFvzJ-TZJxmYuHc7xWyrpeqeCIdCKbLxq72AsBVpcLuF2tiVXMkE55KAvsYHdNrC6RvVHRyqKS3CRjsswi1-c4FKKe6Qc_Q',	''),
    ($album_sn,	'AF1QipM4GRLPVVCCjhLw_vGqHv4rooURimv9soda_A9x',	1280,	718,	'https://lh3.googleusercontent.com/DWZRd6Yzabq1JCswYH_NM6ffkTGDc7v-WMQ51wzoLl_nEnDAFWe75omVrHegec309b0sXBxvUys6bnGe1_pWA5jPLw05d7vMReZuT9Cw4tilSc2ZgMz17aSkcXjpifLUCGBVHBmHF1g',	''),
    ($album_sn,	'AF1QipOdURxOHYvUZ6i6bvWHqPnZT266Blt9AoNC7FvB',	1920,	1280,	'https://lh3.googleusercontent.com/8REDcCMdI3w2Tc9tHmxj4EWjVMNTyRGUx0RdN9t6OLNsUuo7FlhibDkDa5ffA_qPcCZyM5cetnGCpCxPGQllo1TcuNp0dg5beAuf-k78yBTUATMBApNS14WhW_Z4urERccf6sPWwl6Y',	''),
    ($album_sn,	'AF1QipOFzzhkqazTeXa1Hgy26uB4f2XlDS95ri5_V5bn',	1280,	720,	'https://lh3.googleusercontent.com/CWKiFLxg4V-0NkFnSOlWXQ-196cL179QzCnpay3DJbvp6cApe-M5VBkfuXqSk6FyHuSXzoIK3JcPb0k2a6A9P8WrlJSEzqaqAQRtXvYAl1zOTkppUHFWAQLWXVvdTd5a4gQcGGwmraE',	''),
    ($album_sn,	'AF1QipP3F9doznt5nh2CiA7lfwwst2sy_MVDn96UwJ6H',	1280,	853,	'https://lh3.googleusercontent.com/RrTLZHO2FB65r6FJlFVmX-k0EeIQ4xNl-CQxGsbxzfuFiBGcCXg4acyKBRQ8HCvyrUQr8G_buOyjWqGLh-N1AfB0g2a-pvWNKfeivRvb07e3TDPcABnfH4wY7HVdMThgwvxZYgidv5Q',	''),
    ($album_sn,	'AF1QipP3M1QAdGkgFir0R0Q_ZH2qziRx4uGD3yv9Ksrd',	1920,	1280,	'https://lh3.googleusercontent.com/q96YGntFirqkCwI8sLo_1CXU4yxxD4YeMqB0qlnazn3lRlktwOOZvVRkonAp5mUzkrkCArpZgayVEuALIqxdoHm7tLHivj0VzNu_MoPBCp7YnNDC0ce9wnrpxTJ3BRIUT4EYjayNMUQ',	''),
    ($album_sn,	'AF1QipNnS8hCAMC0aKNfHfCpFkXFL6Vk0M_uSmZ1k6nU',	1920,	1362,	'https://lh3.googleusercontent.com/SevEJE-F76VbBuya3szlViVMlIDY7r41BHZ0NL_eyvp2EsgJEeNl2dAf7miqtpTW6PTSHdPgtcuhzAQjK-2D5XPxN4QTVCSazNa3lI4KSV2zX2Wvmyy44rZTnerzj7jzsBbFq7lwNi8',	''),
    ($album_sn,	'AF1QipNTSuUrLFKZwpq9YjQ4Vc3GlGwFoxEnYKTdk6JA',	1920,	1279,	'https://lh3.googleusercontent.com/eN7lp38vUHUFlvf1v81oFkKTxttyNOG-1S6CB3HMBU1bEhcRjp6RjJ9L2mPjYo14KD9laR4M8Y-X5PPB2L3KiVZjDM2p6TCvPDuYUKQPwqwjJeO1CVVT1Cvu96TDZonzzdbFUb55JMg',	''),
    ($album_sn,	'AF1QipM9yD-OzW5FukwpI7nA0j445DOlxtHg3wYOSCPA',	1920,	1249,	'https://lh3.googleusercontent.com/ZA6kD5ZEpNCnS2V6-IbCyaTAiAJoKvJHmNUwwWk1kpo0Mh0MFL7f4-aUdIcYcH3ImYI1b6sAIKDrEptNYlLtjKRTpP2ZlJNn5NVcMI1vcMpBmgE7KpNkG7RIOQJ7EAC5yOLw0dHg9pM',	''),
    ($album_sn,	'AF1QipN-_8e1hBrDJSwfDzJiMkwuX7ReF-IlMtPPhKP_',	1920,	1280,	'https://lh3.googleusercontent.com/3Ry2JCA3juyLEZ1xTkT5ME_2GHczPvRrCHyHovYUlyQlCx9AnKGVrBV9472Mlf0bkgwUlr2f4VnpVaURoXbe3hNrlui3EZLeJ8CbGG20dAK14O4xUnXWD88Fw1vJnPLBYuKIKtRDzTM',	''),
    ($album_sn,	'AF1QipME6wIBVB-rTCyal_H14oJKTbRCjVakHMUtfVBq',	1920,	1280,	'https://lh3.googleusercontent.com/CXgD0Q_xd69L9-0ukfo5M7L-bXSuP9qcPjn0Sf3NcHOk6uz-qBQVAAZ-G33p_vsDzInEE6Dda08I0AB3qDhbfmClW-saxHpiH9UCujDwKd8dOD2m3GZozUbMnABwqigkap8cIxV2Omg',	''),
    ($album_sn,	'AF1QipPcwVsietu_dTRYqWuMg3_XLGTeCFfrmtMisuAr',	1920,	1280,	'https://lh3.googleusercontent.com/hHqkuNAIQ8ZGE0P1dT1uy8hWlo-XRf043Y3wJC3ySHPP89PH1xJ47gyTj2DXlNBqHRvvXp8R6-KDcWNEyIPT68whY4kyc_NExNf2AU2Sec8z2L8WeGMDAvAzfyC9YsTcDLTj83KtDAA',	''),
    ($album_sn,	'AF1QipO62RhYGdbS3xqY_YXyxpi1-f-5zYAd324z9CDB',	1920,	1249,	'https://lh3.googleusercontent.com/O5USu3yO0oFEnuHCAfXWmlq5ajVD00lOSLukoc1slk4oorjqv5JYYUMS2f5TgoDbkF3WC8Tyb-zfqwfPbi1-C6BNpWukjI0D4K1Wtt63Sc991QVTBOL19OoBYbQx4wCS9RvsiJllPaw',	''),
    ($album_sn,	'AF1QipPmSVyerxrLvce3FBtNnv981NObhFfix4eEQqcV',	1920,	1221,	'https://lh3.googleusercontent.com/J4SgnDBc741fEcz20n986FTA65s_X79rTofjTaxmd5lKlM2EI4LuP00BGiovdqOi1dwvIf3O_1yuGpoF4pUDZAr0lOsCJFUUkeTlz4TiFfMF3vw53ig3wojeKsBegD998X3_K0yOTuM',	''),
    ($album_sn,	'AF1QipPgvxXwOBVOnj3rtwlpHg4eWUws_YuIUhQHmzNG',	1920,	1389,	'https://lh3.googleusercontent.com/SRgFUZkjml-WfWGNZsCfnaxczXTpSVN4b2y9958yTGvhAHZTU5QYNatsu9DdPyOdHiWlD9y4fwVjpn-v5s15128dZk5b2WepPKz4hV9LVM-kbE5_bp82ozQHSDdhmGoy5EKyeOIxigg',	''),
    ($album_sn,	'AF1QipPxOnmrCxXsStHGehKgC6D5R8e9sedH4T867Apy',	1920,	1280,	'https://lh3.googleusercontent.com/HlcHg8FkCbFvaUxCKJ_Y6PdiPMa26H3Bnr7Fi2hLCXK_5GXGbGqJbmXsHSjFtNmewM2AaMN9clJY1oeauu4Rst5xXxKP1LnwWERHlh_y-cQznHtxeQOZO-bZ9MsaM79x7SPPEBSMweI',	''),
    ($album_sn,	'AF1QipMTVFw0iX0JVzXFuHgG9BCe6n4TL6CPo6L0KLpg',	1920,	1280,	'https://lh3.googleusercontent.com/JdNIdf0xYMTrJ0qi72Qlv7jr13Q0SwTYJC5fNK1BxDLpk4IXVSvWzlIVrMeMv5M90TkXxr-P42qa1Tn_jpgirAzCdCheQZzZNVAWOFUnGlrMttcJmfwDNpRpDo2S6YumNqIoBkbsF5w',	''),
    ($album_sn,	'AF1QipNJbyW4ka0NKuPnH2el5xwrVsigzoTHMx9k8xj4',	1280,	834,	'https://lh3.googleusercontent.com/Ex09VpY0k5Bg0C6lqvYmnlEBSJ-9RAe7ZodEOoDSo2M37gZ1dv8I85g1YYfeuzfg4wWDwHRlnp71Xw1Da0IcbXBCYpd_OtwVKHQhJgspztJd6H_GVOqSiob2DazRPC-Za9EDUPBanyI',	''),
    ($album_sn,	'AF1QipOa8CNks8UdGH_Z-BNoMq5VsvFt9Tm_ruTrMVQt',	1920,	1280,	'https://lh3.googleusercontent.com/K24hL-B_dT4K76ePrMflVs_mj62NysaiKnvGV7dXs9dwva-a9UDN1A2G-uF_2NUao-HyFNSSwf7u8uLFXDA4XUtrPtlSyQBiNoBcpC2iIh29Ch-zewpGYOcndWeZ44uYSutUfotioTg',	''),
    ($album_sn,	'AF1QipNxm19yYHiLEAP_yNvLStIWtvqCfTWWuXmz2Phv',	1920,	1357,	'https://lh3.googleusercontent.com/Sjo24ACWaEkQUpyH2IZvUPQ1DqZk9Nee0EaY9EEoLWvjDakJC3NtG5V4oqaiYItYDTamrEBL5Nwkox6YIwjP9Q2mue-3Lju9cO5kJyxLKwz5Luzx7mBwgB4koMKKMcGr-NZBuTfmUXk',	''),
    ($album_sn,	'AF1QipNPdAWvUc7MRoJuhpXq4-M-63G8GyQrQAAxXAS0',	1920,	1357,	'https://lh3.googleusercontent.com/eZqFDT5bOBXCqB0WLFevPiol9g--rgzByyL034UeToxholfyCBDVSZ4hPJvSW__vxLLYDsQBNkvfCzUDyV3fKDTZ1NaPLMqW5j7LtO04Kxk1zU1InCZ-7tsYvGLGGBp0oFZBMF7el5w',	''),
    ($album_sn,	'AF1QipNDvrSiFKcOGS2BKaxs8TpErbd5JrpXrUiM9YQs',	1920,	1852,	'https://lh3.googleusercontent.com/zJPxHORVZcOokk7pioNhUQamjzm8qYmuXFhc6SegYjmtp3RPRPfAw45q2DyorKEshmUPoG38rZJ0ykvkh5Zi2cD4XNNbY0MNyJpfOWzt0chVATd4hRohgqKEn2FpBvx8QHmsm3yAc1A',	''),
    ($album_sn,	'AF1QipPWcKkQByvC5v7NIl10ES4dq1J4ypIoT55djFNC',	1920,	1920,	'https://lh3.googleusercontent.com/oRRAQoH-omDmb2ZjEM9TVodUYboosMX_qp6wt57kquEd6baJhj-qtI5oE6N6d2FN-akLWxdurvthCxxtroyG_-TLabovJIuTSUnd70ZlGQflB5cTuuzXV8X2fRslHR5I4QHm1DVvo0E',	''),
    ($album_sn,	'AF1QipNFm4S9CtcBHbUsKrcBeAFxjSNAdO-6ej1sld-t',	1920,	1358,	'https://lh3.googleusercontent.com/z8pWw9o8dgLDsecZXTmuaBzUZOseJtdASPnysQpZGY4v4wrRlDfKpFPK39SDfYegIE6jA3CG6X-d9_yDSs8snrc2MJ87zAxXeLi6km59-ELXmpmY7iuNdSKgp8UVvBcE9JmbbWprKcQ',	''),
    ($album_sn,	'AF1QipPCPUjlmj8sXG4LFmGejz9Bxgeblpy0TkfE9fbH',	1920,	1472,	'https://lh3.googleusercontent.com/oU2gduxaBlX_UuzuyKUolHZPfnAb0QreAC7TQobLfXKI4_kXjj7pllE-yh3WUu_2sipQKdYSmqHG3wd8Oo8Uoqot-LZ1oJldzId-klcUDZjIinguKuyMTBcE2H6l1Mwxuv26WEkk2FQ',	''),
    ($album_sn,	'AF1QipOJPQCkFKDhrbmpZrjaqMSx3qH-hqyB1Jv2aeiv',	1920,	1920,	'https://lh3.googleusercontent.com/yxzWNGiEPkqYB8h62pQNrQq1f6grEd_UG9ECKWQ3SNguNmZ3I1sJfQ9PkX1k8mKh9GlwbPZBWKHvlZoig7n29ZfOYWwGztZTCbN-4KOdNa0fDB-vZHnbUsvz9_UXhMAaJQh0Jm9xb6o',	''),
    ($album_sn,	'AF1QipPUKUHGDq99mwx1_E--PxmizTnN2gRRBQfgB7x8',	1920,	1920,	'https://lh3.googleusercontent.com/hjKCu5kWCP0dV47bmHElAKe4FfTJmy-tKYJMY0SUhN4EP-qv9PSkU1cu-Q5_UhpbR3exPF_GQXdsXAa_XS87dhbiabGZXmfLOoHowkYw0V6MXSrnnJYkRDZdcgbscTHkYk_11tcf0dU',	'')";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

}

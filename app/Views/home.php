<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
    body {
        font-family: Georgia, "Times New Roman", Times, serif;
        color: #555;
    }

    h1, .h1,
    h2, .h2,
    h3, .h3,
    h4, .h4,
    h5, .h5,
    h6, .h6 {
        margin-top: 0;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-weight: normal;
        color: #333;
    }

    /*
     * Override Bootstrap's default container.
     */

    @media (min-width: 1200px) {
      .container {
        width: 970px;
      }
    }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($wordlists)) : ?>
        <form class="" action="/j2team-security-app/save" method="post">
              <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <?php foreach ($wordlists as $key => $wordlist) :?>
                <li role="presentation" <?php echo (0===$key) ? 'class="active"' : ''?>><a href="#<?php echo $wordlist['NAME'];?>" aria-controls="<?php echo $wordlist['NAME'];?>" role="tab" data-toggle="tab"><?php echo $wordlist['NAME'];?></a></li>
                <?php endforeach;?>
            </ul>
            <div class="tab-content">
                <?php foreach ($wordlists as $key => $wordlist) :?>
                    <div role="tabpanel" class="tab-pane <?php echo (0===$key) ? 'active"' : ''?>" id="<?php echo $wordlist['NAME'];?>">
                        <div class="form-group">
                           <label for="J2TeaM[<?php echo $wordlist['NAME'];?>]">List of <?php echo $wordlist['NAME'];?></label>
                           <textarea id="J2TeaM_<?php echo $wordlist['NAME'];?>" name="J2TeaM[<?php echo $wordlist['NAME'];?>]" class="form-control" rows="8" cols="40">
                                <?php foreach ($wordlist['VALUE'] as $domain) :?>
                                    <?php echo $domain."\n";?>
                                <?php endforeach;?>
                           </textarea>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary">Updated</button>
                <a href="/j2team-security-app/export?download=true" target="_blank" class="btn btn-secondary">Export to JSON</a>
            </div>
        </form>
        <?php endif;?>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    function clean_txt(id) {
        var lines = $("textarea#"+id).val().split(/\n/);
        var texts = [];
        for (var i=0; i < lines.length; i++) {
            if (/\S/.test(lines[i])) {
                texts.push($.trim(lines[i]));
            }
        }
        var n = texts.toString().split(",").join("\n");
        $("textarea#"+id).val(n);
    };
    $("textarea").each(function(){
        clean_txt(this.id);
    });
})
</script>
</body>
</html>

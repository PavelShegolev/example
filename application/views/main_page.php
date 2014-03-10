<aside id='aside'>
<?php include 'aside.php';?>
</aside>
<div id='article_position'>
  <article id='arcicle'>
    <dl>
      <dt>
        <h2>What is Lorem Ipsum?</h2>
      </dt>
      <dd>
        <strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown 
        printer took a galley of type and scrambled it to make a type
        specimen book. It has survived not only five centuries, but also the leap into electronic 
        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the 
        release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop 
        publishing software like Aldus PageMaker including versions of Lorem Ipsum.
      </dd>
      <dt><h2>Where does it come from?</h2></dt>
      <dd>
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. 
        It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard 
        McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure 
        Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical 
        literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de 
        Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a 
        treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, 
        "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
        </p>
      </dd>
    </dl>
  </article>
</div>

<br><br>
  <form method='get' action='/main_page/Send_Email' id='form_send_email'>
  <div class="field">
    <label for= 'name'>Your name:</label>
    <input type='text' name='name' value='<?php  echo $this->name;?>'><br>
    
    <label for= 'email'>E-mail:</label>
    <input type='text' name='email' value='<?php  echo $this->email;?>'><br>
    
    <label for= 'type_site'>I want:</label>
    <select name='type_site'>
      <option value='basic site'>basic site</option>
      <option value='site'>site</option>
      <option value='te'>te</option>
    </select><br>
    
    <label for= 'comments'>Comments:</label>
    <textarea cols='20' rows='4' name='comments'><?php  echo $this->comments;?></textarea><br>
 
    <label for= 'code'>Verification code:</label>
    <input type='test' name='code'><br>
    <img src='/main_page/Generate_Captcha' title='code'><br>
    
    <input type='submit' name='send' value='Send mail'>
    <input type='reset' value='Clear'><br>
  </div>
 

<div align='center'>
  <?php
    $m_success= MessageCollector::get_message(success);
    $m_warning= MessageCollector::get_message(warning);
    $m_error= MessageCollector::get_message(error);
    
    if($m_success){
      foreach($m_success as $message)
        echo $message . '<br>';
    }
    
    if($m_warning){
      foreach($m_warning as $message)
        echo $message . '<br>';
    }
    
    if($m_error){
      foreach($m_error as $message)
        echo $message . '<br>';
    }
  ?>
</div>
<br><br>
 </form>

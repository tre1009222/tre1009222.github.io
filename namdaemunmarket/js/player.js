$(function(){
  //비디오객체 선택
  //jquery는 0이라는 값까지 접근해야 video객체를 선택할 수 있다.
  var player=$('video')[0];

  //자바스크립트로 video객체 선택
  var player2=document.getElementById('video');

  //재생/일시정지
  $('#btn-play-pause').click(function(){
    if(player.paused){//일시정지 상태이면
      player.play();//재생처리
      $(this).find('i').text('pause');
    }else{//재생이면
      player.pause();//일시정지처리
      $(this).find('i').text('play_arrow');
    }
  })

  //다시시작
  $('#btn-replay').click(function(){
    player.currentTime=0;//재생되는 시간을 0으로 초기화
    player.play();
  })

  //음소거
  $('#btn-volume').click(function(){
    if(player.muted){//음소거 상태
      player.muted=false;
      $(this).find('i').text('volume_up');
    }else{//음소거 상태 아님
      player.muted=true;
      $(this).find('i').text('volume_off');
    }
  })

  //전체화면
  $('#btn-fullscreen').click(function(){
    if($(this).find('i').text()=='fullscreen'){//전체화면
      $('.video #video').css('width', '100%');
      $('body').addClass('fullscreen');
      $(this).find('i').text('fullscreen_exit');
    }else{
      $('.video #video').css('width', '686px');
      $('body').removeClass('fullscreen');
      $(this).find('i').text('fullscreen');
    }
  })
})

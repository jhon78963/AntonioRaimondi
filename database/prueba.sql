DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `alumnosxaula`()
select
    concat(g.grado_descripcion, ' ', s.secc_descripcion) as aula,
    count(a.alum_id) as cantidad
from matriculas m
    inner join alumnos_secciones a ON m.alum_id = a.alum_id
    inner join aulas sg ON a.aula_id = sg.aula_id
    inner join grados g ON sg.grado_id = g.grado_id
    inner join secciones s ON sg.secc_id = s.secc_id
    where a.asec_estado = '1' and m.matr_estado = '1'
    group by concat(g.grado_descripcion, ' ', s.secc_descripcion)$$
DELIMITER ;
